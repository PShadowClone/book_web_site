<?php


return [

    'drivers' => 'السائقين',
    'driver' => 'السائق',
    'phone' => 'رقم الجوال ',
    'single' => 'فرد',
    'company' => 'شركة',
    'inst_rate' => 'نسبة ربح المؤسسة',
    'company_phone' => 'رقم الهاتف',
    'company_email' => 'الموقع الالكتروني',
    'company_address' => 'عنوان الشركة',
    'password' => 'كلمة المرور',
    'confirm_password' => 'اعادة كلمة المرور',
    'name' => 'اسم السائق',
    'mobile' => 'رقم الجوال',
    'email' => 'البريد الالكتروني',
    'active' => 'مفعل',
    'inactive' => 'غير مفعل',
    'area' => 'المنطقة',
    'city' => 'المدينة',
    'quarter' => 'الحي',
    'areas' => 'المناطق',
    'instProfit' => 'سداد المؤسسة',
    'add_area' => 'اضافة منطقة',
    'addArea' => 'اضافة منطقة',
    'pureProfits' => 'صافي الأرباح',
    'totalSales' => 'مجمل المبيعات',
    'beenPayed' => 'تم تسديده',
    'reset' => 'المتبقي لسداد',
    'status' => 'الحالة',
    'addDriver' => 'اضافة سائق جديد',
    'editDriver' => 'تعديل بيانات السائق',
    'properties' => 'خصائص متعلقة بالسائق',
    'evaluations' => 'التقيمات',


    /**
     *
     *  success messages
     *
     */
    'stored_successfully' => 'تمت عملية اضافة السائق بنجاح',
    'updated_successfully' => 'تم تحديث بيانات السائق بنجاح',
    'deleted_successfully' => 'تمت عملية حذف السائق بنجاح',
    'show_successfully' => 'تم عرض بيانات السائقين بنجاح',
    'activated' => 'تم تفعيل السائق بنجاح',
    'deactivated' => 'تم ايقاف السائق',
    'area_stored_successfully' => 'تم اضافة المنطقة بنجاح',


    /**
     *
     *  error messages
     *
     */
    'stored_error' => 'عذراً, حدث خلل اثناء عملية حفظ السائق',
    'not_found' => 'عذراً, السائق غير موجود',
    'edit_error' => 'عذراً, حدث خلل أثناء عملية عرض بيانات السائق لتعديل',
    'updated_error' => 'عذراً, حدث خلل أثناء عملية تعديل بيانات السائق ',
    'deleted_error' => 'عذراً, حدث خلل أثناء عملية حذف بيانات السائق ',
    'show_error' => 'عذراً, حدث خلل أثناء عرض بيانات السائقين ',
    'status_changed_error' => 'عذراً, حدث خلل اثناء تغيير حالة السائق',


    /**
     *
     *  Validation messages
     *
     */

    'name_required' => 'اسم السائق مطلوب',
    'name_string' => 'يجب ان يكون الاسم عبارة عن نص فقط',
    'name_min' => 'اسم السائق يجب ان يتكون على الأقل من 3 أحرف',
    'password_required' => 'كلمة المرور مطلوبة',
    'password_min' => 'كلمة المرور يجب ان لا تقل عن 6 خانات',
    'confirm_password_required' => 'يجب ان تتطابق كلمة المرور مع تأكيد كلمة المرور',
    'email_required' => 'البريد الالكتروني مطلوب',
    'email_email' => 'يجب ادخال البريد الالكتروني بالصورة الصحيحة : example@hotmail.com',
    'phone_required' => 'رقم الهاتف مطلوب',
    'phone_number' => 'رقم الهاتف يجب ان يحتوي على ارقام فقط',
    'phone_min' => 'رقم الهاتف يجب ان يحتوي على الاقل على 5 أرقام',
    'phone_max' => 'رقم الهاتف يجب ان يحتوي على الأكتر على 15 رقم',
    'phone_unique' => 'رقم الجوال مسجل مسبق',
    'mobile_required' => 'رقم الجوال مطلوب',
    'mobile_number' => 'يجب ان يحتوي رقم الجوال على ارقام فقط',
    'mobile_min' => 'رقم الجوال يجب ان يحتوي على الاقل على 5 أرقام',
    'mobile_max' => 'رقم الجوال يجب ان يحتوي على الاقل على 5 أرقام',
    'address_required' => 'العنوان مطلوب',
    'quarter_required' => 'الحي مطلوب',
    'quarter_exists' => 'عذراً, يحب اختيار حي من الأحياء المتاحة فقظ',
    'inst_profit_rate_required' => 'نسبة أرباح المؤسسة مطلوبة',
    'inst_profit_rate_min' => 'نسبة أرباح المؤسسة لا تقل عن %1',
    'inst_profit_rate_max' => 'نسبة أرباح المؤسسة لا تزيد عن 100٪',
    'inst_profit_rate_number' => 'نسبة أرباح المؤسسة يجب ان تكون رقم',
    'status_required' => 'يجب اختيار حالة السائق',
    'status_in' => 'يجب اختيار الحالة بناءً على القائمة المتاحة',
    'company_phone_required' => 'رقم هاتف الشركة مطلوب',
    'company_phone_min' => 'رقم الهاتف يجب ان يحتوي على الاقل على 5 أرقام',
    'company_phone_max' => 'رقم الهاتف يجب ان يحتوي على الأكتر على 15 رقم',
    'company_email_required' => 'البريد االالكتروني للشركة مطلوب',
    'company_address_required' => 'عنوان الشركة مطلوب',
];