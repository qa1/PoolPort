<?php

namespace PoolPort\Parsian;

class ParsianErrorException extends \Exception
{
    public static $errors = array(
        -32768 =>  'خطاي ناشناخته رخ داده است',
        -1552  =>  'برگشت تراکنش مجاز نمی باشد',
        -1551  =>  'برگشت تراکنش قب ًلا انجام شده است',
        -1550  =>  'برگشت تراکنش در وضعیت جاري امکان پذیر نمی باشد',
        -1549  =>  'زمان مجاز براي درخواست برگشت تراکنش به اتمام رسیده است',
        -1548  =>  'فراخوانی سرویس درخواست پرداخت قبض ناموفق بود',
        -1540  =>  'تایید تراکنش ناموفق می باشد',
        -1536  =>  'فراخوانی سرویس درخواست شارژ تاپ آپ ناموفق بود',
        -1533  =>  'تراکنش قبلاً تایید شده است',
        -1532  =>  'تراکنش از سوي پذیرنده تایید شد',
        -1531  =>  'تایید تراکنش ناموفق امکان پذیر نمی باشد',
        -1530  =>  'پذیرنده مجاز به تایید این تراکنش نمی باشد',
        -1528  =>  'اطلاعات پرداخت یافت نشد',
        -1527  =>  ' انجام عملیات درخواست پرداخت تراکنش خرید ناموفق بود',
        -1507  =>  'تراکنش برگشت به سوئیچ ارسال شد',
        -1505  =>  'تایید تراکنش توسط پذیرنده انجام شد',
        -138   =>  'عملیات پرداخت توسط کاربر لغو شد',
        -132   =>  ' مبلغ تراکنش کمتر از حداقل مجاز میباشد',
        -131   =>  'Token نامعتبر می باشد',
        -130   =>  'Token زمان منقضی شده است',
        -128   =>  'قالب آدرس IP معتبر نمی باشد',
        -127   =>  'آدرس اینترنتی معتبر نمی باشد',
        -126   =>  'کد شناسایی پذیرنده معتبر نمی باشد',
        -121   =>  'رشته داده شده بطور کامل عددي نمی باشد',
        -120   =>  'طول داده ورودي معتبر نمی باشد',
        -119   =>  'سازمان نامعتبر می باشد',
        -118   =>  'مقدار ارسال شده عدد نمی باشد',
        -117   =>  'طول رشته کم تر از حد مجاز می باشد',
        -116   =>  'طول رشته بیش از حد مجاز می باشد',
        -115   =>  'شناسه پرداخت نامعتبر می باشد',
        -114   =>  'شناسه قبض نامعتبر می باشد',
        -113   =>  'پارامتر ورودي خالی می باشد',
        -112   =>  'شماره سفارش تکراري است',
        -111   =>  'مبلغ تراکنش بیش از حد مجاز پذیرنده می باشد',
        -108   =>  'قابلیت برگشت تراکنش براي پذیرنده غیر فعال می باشد',
        -107   =>  'قابلیت ارسال تاییده تراکنش براي پذیرنده غیر فعال می باشد',
        -106   =>  'قابلیت شارژ براي پذیرنده غیر فعال می باشد',
        -105   =>  'قابلیت تاپ آپ براي پذیرنده غیر فعال می باشد',
        -104   =>  'قابلیت پرداخت قبض براي پذیرنده غیر فعال می باشد',
        -103   =>  'قابلیت خرید براي پذیرنده غیر فعال می باشد',
        -102   =>  'تراکنش با موفقیت برگشت داده شد',
        -101   =>  'پذیرنده اهراز هویت نشد',
        -100   =>  'پذیرنده غیرفعال می باشد',
        -1     =>  'خطای سرور',
        0      =>  ' عملیات موفق می باشد',
        1      =>  'صادرکننده کارت از انجام تراکنش صرف نظر کرد',
        2      =>  'عملیات تاییدیه این تراکنش قبلا با موفقیت صورت پذیرفته است',
        3      =>  'پذیرنده ي فروشگاهی نامعتبر می باشد',
        5      =>  'از انجام تراکنش صرف نظر شد',
        6      =>  'بروز خطایی ناشناخته',
        8      =>  'باتشخیص هویت دارنده ي کارت، تراکنش موفق می باشد',
        9      =>  'درخواست رسیده در حال پی گیري و انجام است',
        10     =>  ' تراکنش با مبلغی پایین تر از مبلغ درخواستی )کمبود حساب مشتري ( پذیرفته شده است',
        12     =>  ' تراکنش نامعتبر است',
        13     =>  'مبلغ تراکنش نادرست است',
        14     =>  'شماره کارت ارسالی نامعتبر است (وجود ندارد)',
        15     =>  ' صادرکننده ي کارت نامعتبراست (وجود ندارد)',
        17     =>  'مشتري درخواست کننده حذف شده است',
        20     =>  'در موقعیتی که سوئیچ جهت پذیرش تراکنش نیازمند پرس و جو از کارت است ممکن است درخواست از کارت ( ترمینال) بنماید این پیام مبین نامعتبر بودن جواب است',
        21     =>  ' در صورتی که پاسخ به در خواست ترمینا ل نیازمند هیچ پاسخ خاص یا عملکردي نباشیم این پیام را خواهیم داشت',
        22     =>  'تراکنش مشکوك به بد عمل کردن ( کارت ، ترمینال ، دارنده کارت ) بوده است لذا پذیرفته نشده است',
        30     =>  ' قالب پیام داراي اشکال است',
        31     =>  'پذیرنده توسط سوئی پشتیبانی نمی شود',
        32     =>  'تراکنش به صورت غیر قطعی کامل شده است ( به عنوان مثال تراکنش سپرده گزاري که از دید مشتري کامل شده است ولی می بایست تکمیل گردد',
        33     =>  'تاریخ انقضاي کارت سپري شده است',
        38     =>  'تعداد دفعات ورود رمزغلط بیش از حدمجاز است. کارت توسط دستگاه ضبط شود',
        39     =>  'کارت حساب اعتباري ندارد',
        40     =>  'عملیات درخواستی پشتیبانی نمیگردد',
        41     =>  'کارت مفقودي می باشد',
        43     =>  'کارت مسروقه می باشد',
        45     =>  'قبض قابل پرداخت نمیباشد',
        51     =>  'موجودي کافی نمی باشد',
        54     =>  'تاریخ انقضاي کارت سپري شده است',
        55     =>  'رمز کارت نا معتبر است',
        56     =>  'کارت نا معتبر است',
        57     =>  'انجام تراکنش مربوطه توسط دارنده‌ی کارت مجاز نمی‌باشد',
        58     =>  'انجام تراکنش مربوطه توسط پایانه ي انجام دهنده مجاز نمی باشد',
        59     =>  'کارت مظنون به تقلب است',
        61     =>  'مبلغ تراکنش بیش از حد مجاز می باشد',
        62     =>  'کارت محدود شده است',
        63     =>  ' تمهیدات امنیتی نقض گردیده است',
        65     =>  'تعداد درخواست تراکنش بیش از حد مجاز می باشد',
        68     =>  'پاسخ لازم براي تکمیل یا انجام تراکنش خیلی دیر رسیده است',
        69     =>  'تعداد دفعات تکرار رمز از حد مجاز گذشته است',
        75     =>  'تعداد دفعات ورود رمزغلط بیش از حدمجاز است',
        78     =>  'کارت فعال نیست',
        79     =>  'حساب متصل به کارت نا معتبر است یا داراي اشکال است',
        80     =>  'درخواست تراکنش رد شده است',
        81     =>  'کارت پذیرفته نشد',
        83     =>  'سرویس دهنده سوئیچ کارت تراکنش را نپذیرفته است',
        84     =>  ' در تراکنشهایی که انجام آن مستلزم ارتباط با صادر کننده است در صورت فعال نبودن صادر کننده این پیام در پاسخ ارسال خواهد شد',
        91     =>  'سیستم صدور مجوز انجام تراکنش موقتا غیر فعال است و یا زمان تعیین شده براي صدو مجوز به پایان رسیده است',
        92     =>  'مقصد تراکنش پیدا نشد',
        93     =>  'امکان تکمیل تراکنش وجود ندارد',
    );

    public function __construct($action)
    {
        parent::__construct(self::getError($action));
    }

    public static function getError($action)
    {
        if (isset(self::$errors[$action])) {
            return $action." ".self::$errors[$action];
        } else {
            return $action;
        }
    }
}
