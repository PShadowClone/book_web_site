<?php

return [

    'in_city' => 'داخل المدينة',
    'out_city' => 'خارج المدينة',
    'code' => 'الرقم',
    'addPromoCode' => 'اضافة برمو كود جديد',
    'discount_rate' => 'نسبة الخصم',
    'promo_do_remove' => 'هل انت متأكد من حذف البروموكود ؟ ',
    'confirm_removing' => 'تأكيد الحذف',
    'settings' => 'الاعدادات',
    'discounts' => 'قيمة التوصيل',
    'promocodes' => 'البروموكود',
    'client_name' => 'اسم العميل',
    'promo_code'=> 'بروموكود',


    /**
     *
     * success messages
     *
     */

    'saved_successfully' => 'تم حفظ البيانات بنجاح',
    'promo_saved_successfully' => 'تم حفظ البروموكود بنجاح',
    'promo_show_successfully' => 'تم عرض  جميع البروموكود ',
    'promo_removed_successfully' => 'تم حذف البرومو كود بنجاح ',

    /**
     *
     * error messages
     *
     *
     */

    'saved_error' => 'عذراً, حدث خلل اثناء حفظ البيانات ',
    'promo_saved_error' => 'عذراً, حدث خلل اثناء حفظ البروموكود ',
    'promo_show_error' => 'عذراً, حدث خلل اثناء عرض بيانات البروموكود ',
    'promo_not_found' => 'البروموكود غير موجود',
    'promo_removed_error' => 'عذراً, حدث خلل اثناء حذف البروموكود',


    /**
     *
     * validation messages
     *
     */
    'in_city_required' => 'نسبة الخصم لتوصيل داخل المدينة مطلوبة',
    'out_city_required' => 'نسبة الخصم لتوصيل خارج المدينة مطلوبة',
    'in_city_in_city_numeric' => 'نسبة الخصم داخل المدينة يجب ان تكون ارقاماً فقط',
    'in_city_digits_between' => 'نسبة الخصم يجب ان تكون بين 1 الى 100',
    'out_city_in_city_numeric' => 'نسبة الخصم خارج المدينة يجب ان تكون ارقاماً فقط',
    'out_city_digits_between' => 'نسبة الخصم يجب ان تكون بين 1 الى 100',
    'discount_rate_digits_between' => 'يجب ان تكون نسبة الخصم من 1 الى 100',
    'discount_rate_required' => 'نسبة الخصم مطلوبة',
    'promo_code_is_required' => 'يجب ادخال البروموكود',
    'promo_already_exist' => 'البروموكود مضاف مسبقاً',
];