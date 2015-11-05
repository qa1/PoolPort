<?php

namespace PoolPort\Sadad;

use SoapClient;
use PoolPort\Config;
use PoolPort\PortAbstract;
use PoolPort\PortInterface;
use PoolPort\DataBaseManager;

class Sadad extends PortAbstract implements PortInterface
{
    /**
     * Url of sadad gateway web service
     *
     * @var string
     */
    protected $serverUrl = 'https://sadad.shaparak.ir/services/MerchantUtility.asmx?wsdl';

    /**
     * Form generated by sadad gateway
     *
     * @var string
     */
    private $form = '';

    /**
     * {@inheritdoc}
     */
    public function __construct(Config $config, DataBaseManager $db, $portId)
    {
        parent::__construct($config, $db, $portId);
    }


    /**
     * {@inheritdoc}
     */
    public function set($amount)
    {
        $this->amount = intval($amount);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function with(array $data)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function ready()
    {
        $this->sendPayRequest();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function redirect()
    {
        $form = $this->form;
        include __DIR__.'/submitForm.php';
    }

    /**
     * {@inheritdoc}
     */
    public function verify($transaction)
    {
        parent::verify($transaction);

        $this->verifyPayment();

        return $this;
    }

    /**
     * Send pay request to server
     *
     * @return void
     *
     * @throws SadadException
     */
    protected function sendPayRequest()
    {
        $this->newTransaction();

        $this->form = '';

        try{
            $soap = new SoapClient($this->serverUrl);

            $response = $soap->PaymentUtility(
                $this->config->get('sadad.merchant'),
                $this->amount,
                $this->transactionId(),
                $this->config->get('sadad.transactionKey'),
                $this->config->get('sadad.terminalId'),
                $this->buildQuery($this->config->get('sadad.callback-url'), array('transaction_id' => $this->transactionId()))
            );

            if(!isset($response['RequestKey']) || !isset($response['PaymentUtilityResult'])) {
                $this->newLog(SadadResult::INVALID_RESPONSE_CODE, SadadResult::INVALID_RESPONSE_MESSAGE);
                throw new SadadException(SadadResult::INVALID_RESPONSE_MESSAGE, SadadResult::INVALID_RESPONSE_CODE);
            }

            $this->form = $response['PaymentUtilityResult'];

            $this->refId = $response['RequestKey'];

            $this->transactionSetRefId();
        } catch (\SoapFault $e) {
            $this->newLog(SadadResult::ERROR_CONNECT, SadadResult::ERROR_CONNECT_MESSAGE);
            throw new SadadException(SadadResult::ERROR_CONNECT_MESSAGE, SadadResult::ERROR_CONNECT);
        }
    }

    /**
     * Verify user payment from bank server
     *
     * @param object $transaction
     * @throws SadadException
     */
    protected function verifyPayment($transaction)
    {
        $soap = new SoapClient($this->serverUrl);

        $result = $soap->CheckRequestStatusResult(
            $this->transactionId(),
            $this->config->get('sadad.merchant'),
            $this->config->get('sadad.terminalId'),
            $this->config->get('sadad.transactionKey'),
            $this->refId(),
            $this->amount
        );

        if(empty($result) || !isset($result->AppStatusCode))
            throw new SadadException('در دریافت اطلاعات از بانک خطایی رخ داده است.');

        $statusResult = strval($result->AppStatusCode);
        $appStatus = strtolower($result->AppStatusDescription);

        $message = $this->getMessage($statusResult, $appStatus);

        $this->newLog($statusResult, $message['fa']);

        if($statusResult == 0 && $appStatus === 'commit') {
            $this->refId = $transaction->ref_id;

            $this->trackingCode = $result->TraceNo;
            $this->cardNumber = $result->CustomerCardNumber;
            $this->transactionSucceed();
        } else {
            $this->transactionFailed();
            throw new SadadException($message['fa'], $statusResult);
        }
    }

    /**
     * Register error to error list
     *
     * @param int $code
     * @param string $message
     *
     * @return array|null
     *
     * @throws SadadException
     */
    private function getMessage($code, $message)
    {
        $result = SadadResult::codeResponse($code,$message);
        if (!$result) {
            $result = array(
                'code' => SadadResult::UNKNOWN_CODE,
                'message' => SadadResult::UNKNOWN_MESSAGE,
                'fa' => 'خطای ناشناخته',
                'en' => 'Unknown Error',
                'retry' => false
            );
        }

        return $result;
    }
}
