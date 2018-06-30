<?php


return [


    'name' => 'اسم المكتبة',
    'library' => 'المكتبة',
    'libraries' => 'المكتبات',
    'phone' => 'رقم الهاتف',
    'mobile' => 'رقم الجوال',
    'password' => 'كلمة المرور',
    'confirm_password' => 'تأكيد كلمة المرور',
    'area' => 'المنطقة',
    'city' => 'المدينة',
    'quarter' => 'الحي',
    'address' => 'العنوان',
    'active' => 'مفعل',
    'inactive' => 'غير مفعل',
    'inst_profit_rate' => 'نسبة ربح المؤسسة',
    'email' => 'البريد الالكتروني',
    'map' => 'الخريطة',
    'instProfit' => 'سداد المؤسسة',
    'requests' => 'طلبات المكتبة',
    'requestsForConfirming' => 'طلبات المكتبة (لتأكيد)',
    'totalSales' => 'مجمل المبيعات',
    'beenPayed' => 'تم تسديده',
    'reset' => 'المتبقي',
    'cache' => 'كاش',
    'bank_transaction' => 'تحويل بنكي',
    'add_profits' => 'اضافة سداد',
    'editLibraryProfit' => 'تحديث السداد',
    'addLibraryProfit' => 'سداد جديد',
    'profitMoney' => 'قيمة السداد',
    'status' => 'الحالة',
    'addLibrary' => 'مكتبة جديدة',
    'editLibrary' => 'تعديل المكتبة',
    'properties' => 'خصائص المكتبة',
    'pureProfits' => 'صافي الأرباح',
    'commercial_record' => 'السجل التجاري',


    /*
     *
     *
     *   Success messages
     *
     *
     * */

    'stored_successfully' => 'تمت عملية تسجيل المكتبة بنجاح',
    'updated_successfully' => 'تم تحديث بياناتا المكتبة بنجاح',
    'show_successfully' => 'تم عرض بيانات المكتبات بنجاح',
    'removed_successfully' => 'تم حذف المكتبة بنجاح',
    'payment_updated_successfully' => 'تم تحديث السداد بنجاح',
    'payment_deleted_successfully' => 'تم حذف السداد بنجاح',
    'payment_show_successfully' => 'تم عرض بيانات السداد بنجاح',
    'payment_saved_successfully' => 'تم حفظ بيانات السداد بنجاح',


    /*
     *
     *
     *    Error messages
     *
     *
     * */

    'stored_error' => 'حدث خلل اثناء تسجيل المكتبة الجديدة',
    'library_not_found' => 'عذراً, المكتبة غير مُسجلة مسبقاً',
    'cannot_edit' => 'عذراً, لا تملك الصلاحية لتعديل بيانات المكتبة',
    'illegal_remove' => 'عذراً, لاتملك الصلاحية لحذف المكتبة',
    'removed_error' => 'عذراً, حدث خلل أثناء حذف بيانات المكتبة',
    'show_error' => 'عذراً, حدث خلل اثناء عرض بيانات المكتبات',
    'updated_error' => 'عذراً, حدث خلل اثناء تحديث بيانات المكتبة',
    'payment_not_found' => 'السداد غير موجود',
    'not_enough_money' => 'عذراً, أنت لاتملك الرصيد الكافي لسداد',
    'more_than_enough_money' => 'عذراً, أنت تحاول سداد المؤسسة بأكثر من القيمة المتبقية لسداد',
    'payments_updated_error' => 'عذراً,حدث خلل اثناء تحديث بيانات السداد',
    'payments_deleted_error' => 'عذراً,حدث خلل اثناء حذف بيانات السداد',
    'payments_show_error' => 'عذراً,حدث خلل اثناء عرض بيانات السداد',
    'payments_saved_error' => 'عذراً,حدث خلل اثناء عرض بيانات السداد',

    /*
     *
     *
     *       Validation messages
     *
     *
     * */
    'name_required'=>'اسم المكتبة مطلوب',
    'name_string'=>'يجب ان يكون الاسم عبارة عن نص فقط',
    'name_min'=>'اسم المكتبة يجب ان يتكون على الأقل من ٣ أحرف',
    'password_required'=>'كلمة المرور مطلوبة',
    'password_min'=>'كلمة المرور يجب ان لا تقل عن ٦ خانات',
    'confirm_password_required'=>'يجب ان تتطابق كلمة المرور مع تأكيد كلمة المرور',
    'email_required'=> 'البريد الالكتروني مطلوب',
    'email_email'=>'يجب ادخال البريد الالكتروني بالصورة الصحيحة : example@hotmail.com',
    'phone_required'=>'رقم الهاتف مطلوب',
    'phone_number'=>'رقم الهاتف يجب ان يحتوي على ارقام فقط',
    'phone_min'=>'رقم الهاتف يجب ان يحتوي على الاقل على ٥ أرقام',
    'phone_max'=>'رقم الهاتف يجب ان يحتوي على الأكتر على ١٥ رقم',
    'mobile_required'=>'رقم الجوال مطلوب',
    'mobile_number'=>'يجب ان يحتوي رقم الجوال على ارقام فقط',
    'mobile_min'=>'رقم الجوال يجب ان يحتوي على الاقل على ٥ أرقام',
    'mobile_max'=>'رقم الجوال يجب ان يحتوي على الاقل على ٥ أرقام',
    'address_required'=>'العنوان مطلوب',
    'quarter_required'=>'الحي مطلوب',
    'quarter_exists'=>'عذراً, يحب اختيار حي من الأحياء المتاحة فقظ',
    'inst_profit_rate_required'=>'نسبة أرباح المؤسسة مطلوبة',
    'inst_profit_rate_min'=>'نسبة أرباح المؤسسة لا تقل عن %١',
    'inst_profit_rate_max'=>'نسبة أرباح المؤسسة لا تزيد عن ١٠٠٪',
    'inst_profit_rate_number'=>'نسبة أرباح المؤسسة يجب ان تكون رقم',
    'status_required'=>'يجب اختيار حالة المكتبة',
    'status_in'=>'يجب اختيار الحالة بناءً على القائمة المتاحة',


];