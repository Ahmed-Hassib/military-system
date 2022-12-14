<?php

/**
 * ARABIC LANGUAGE
 */
function languageAr($phrase)
{
    static $lang = array(

        'HI'                            => 'اهــلاً',
        'LOGIN'                         => 'تسجيل دخول',
        'LOGOUT'                        => 'تسجيل خـروج',
        'USERNAME'                      => 'اسم المستخدم',
        'PASSWORD'                      => 'الرقم السرى',
        'DASHBOARD'                     => 'لوحة التحكم',
        'SOLDIER'                       => 'جــندى',
        'NAME'                          => 'الاســـم',
        'SOLDIER NAME'                  => 'اســـم الجــندى',
        'PHONE1'                        => 'التليفـــون',
        'PHONE2'                        => 'تليفـــون اقرب الاقارب',
        'SOLDIER PHONE1'                => 'تليفـــون الجنــدى',
        'SOLDIER PHONE2'                => 'تليفـــون اقرب الاقارب',
        'MILITIRAY NUMBER'              => 'الــرقــم العـسكــرى',
        'ADDRESS'                       => 'العنــوان',
        'SOLDIER ADDRESS'               => 'عنــوان الجنـــدى',
        'NATIONAL ID'                   => 'الــرقــم القــومــــى',
        'THE SOLDIER'                   => 'الجــندى',
        'SOLDIERS'                      => 'جــنود',
        'THE SOLDIERS'                  => 'الجــنود',
        'UNIT'                          => 'وحــدة',
        'UNIT NAME'                     => 'اســم الوحــدة',
        'UNIT NAME IN ARABIC'           => 'اســم الوحــدة باللغـة العربيــة',
        'UNIT NAME IN ENGLISH'          => 'اســم الوحــدة باللغـة الانجليزيـة',
        'UNIT TYPE'                     => 'نــوع الوحــدة',
        'THE UNIT'                      => 'الوحــدة',
        'UNITS'                         => 'وحــدات',
        'THE UNITS'                     => 'الوحــدات',
        'ALL THE UNITS'                 => 'جميــع الوحــدات',
        'BASIC UNIT'                    => 'وحــدة اســاسيــة',
        'THE BASIC UNIT'                => 'الوحــدة الاســاسيــة',
        'BASIC UNITS'                   => 'وحــدات اســاسيــة',
        'THE BASIC UNITS'               => 'الوحــدات الاســاسيــة',
        'CURRENT UNIT'                  => 'وحــدة حــاليــة',
        'THE CURRENT UNIT'              => 'الوحــدة الحــاليــة',
        'CURRENT UNITS'                 => 'وحــدات حــاليــة',
        'THE CURRENT UNITS'             => 'الوحــدات الحــاليــة',
        'ADD NEW UNIT'                  => 'اضــافة وحــدة جديــدة',
        'EDIT UNIT'                     => 'تعــديـل بيـانات وحــدة',
        'EDIT THE UNIT'                 => 'تعــديـل بيـانات الوحـــدة',
        'DELETE UNIT'                   => 'حــذف وحــدة',
        'DELETE THE UNIT'               => 'حــذف الوحـــدة',
        'DELETE'                        => 'حـــذف',
        'CLOSE'                         => 'اغــلاق',
        'ADD'                           => 'اضــافة',
        'SAVE CHANGES'                  => 'حفظ التغييرات',
        'CONTROL'                       => 'التــحكم',
        'QUALIFICATION'                 => 'المــــؤهـــــل',
        'SPECIALIZATION'                => 'التخـصـــص',
        'JOINED DATE'                   => 'تــاريــخ الضــــــم',
        'DISCHARGE DATE'                => 'تــاريــخ التسريـــح',
        'AVATAR'                        => 'صورة مصغرة',
        'RESET'                         => 'افراغ الحقول',
        'OTHERS'                        => 'اخــرى',
        'TAKE A BACKUP'                 => 'أخذ نسخة احتياطية',

        'AUTOMATED 830 CENTER'          => 'مركز ٨٣٠ الآلى',
        'USERNAME IS REQUIRED'          => 'اسم المستخدم مطلوب',
        'PASSWORD IS REQUIRED'          => 'الرقم السرى مطلوب',
        'USERNAME OR PASSWORD IS WRONG' => 'اسم المستخدم او كلمة المرور خطأ',
        'UNIT NAME IS EXIST BEFORE'     => 'اسم هذة الوحــدة موجود بالفعــل',
        'UNIT NAME CANNOT BE EMPTY'     => 'اســم الوحــدة لايمكــن ان يكــون فارغــا',
        'UNIT ADDED SUCESSFULLY'        => 'تـم اضــافة الوحــدة بنجــاح',
        'UNIT UPDATED SUCESSFULLY'      => 'تـم تعـديــل الوحــدة بنجــاح',
        'UNIT DELETED SUCESSFULLY'      => 'تـم حــذف الوحــدة بنجــاح',
        'ADD NEW SOLDIER'               => 'اضــافة جنــدى جــديــد',
        'SPECIALIZATIONS NOT ENTERED'   => 'التخصصات لم يتم ادخالها',
        'UNITS NOT ENTERED'             => 'الوحدات لم يتم ادخالها',
        'PERSONAL INFO'                 => 'المعلومات الشخصية',
        'PERSONAL PHOTO'                => 'الصورة الشخصية',
        'CONNECTION INFO'               => 'معلوات الاتصال',
        'SOME STATISTICS'               => 'بـعــض الاحـصــائـيـــات',
        'SPECIALIZATIONS'               => 'التخـصـصــــات',
        'SPECIALIZATION NAME'           => 'اســم التخصـص',
        'SPECIALIZATION NEW NAME'       => 'اســم التخصـص الجديد',
        'ADD NEW SPECIALIZATION'        => 'اضــافــة تخصـص جــديــد',
        'EDIT SPECIALIZATION'           => 'تعـديل تخصـص',
        'DELETE SPECIALIZATION'         => 'حذف تخصـص',
        'EDIT SOLDIER INFO'             => 'تعديـل بيــانـات جنـدى',
        'DELETE SOLDIER INFO'           => 'حــذف بيــانـات جنـدى',
        'SHOW ALL SOLDIERS'             => 'عـرض جمــيع الجنــود',
        'FAMILY INFO'                   => 'بيـانات العائلة',
        'RELIGION'                      => 'الديانة',
        'STATUS'                        => 'الحالة الاجتماعية',
        'FATHER JOB'                    => 'وظيفة الاب',
        'MOTHER JOB'                    => 'وظيفة الام',
        'MUSLIM'                        => 'مسلم',
        'CRISTEN'                       => 'مسيحي',
        'SINGLE'                        => 'اعزب',
        'MARRIAGE'                      => 'متزوج',
        'NUMBER OF CHILD'               => 'عدد الاولاد',
        'NUMBER OF SOLDIERS'            => 'عدد الجـنـــود',
        'WELCOME BACK'                  => 'مرحبــاً بك مجدداً',

        
        'ARE YOU SURE TO DELETE THIS UNIT?'                     => 'هـل انت متـأكد من حـذف هـذة الوحــدة؟',
        'THERE IS NO PAGE WITH THIS NAME'                       => 'لا توجد صفحة بهذا الاسم',
        'YOU CANNOT ACCESS THIS PAGE DIRECTLY'                  => 'لا يمكنـك الوصول الي هذة الصفحة مباشرةً',
        'YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE'     => 'ليس لدسك الصلاحية للدخول علي هذة الصفحة',
        'UNIT INFO/JOINED DATE/SPECIALIZATION'                  => 'معلومات الوحدة/تاريخ الضم/التخصص',
        'SOLDIER PHOTO CANNOT BE EMPTY'                         => 'صورة الجندى لا يمكن ان تكون فارغة',
        'MILITIRAY NUMBER CANNOT BE EMPTY'                      => 'الرقم العسكرى لا يمكن ان يكون فارغ',
        'NATIONAL ID CANNOT BE EMPTY'                           => 'الرقم القومى لا يمكن ان يكون فارغ',
        'NATIONAL ID CANNOT BE LESS THAN 14 CHARACTER'          => 'الرقم القومى لا يمكن ان يكون اقل من 14 رقم',
        'NAME CANNOT BE EMPTY'                                  => 'الاسم لا يمكن ان يكون فارغ',
        'ADDRESS CANNOT BE EMPTY'                               => 'العنوان لا يمكن ان يكون فارغ',
        'QUALIFICATION CANNOT BE EMPTY'                         => 'التخصص لا يمكن ان يكون فارغ',
        'BASIC UNIT CANNOT BE EMPTY'                            => 'الوحدة الاساسية لا يمكن ان تكون فارغة',
        'CURRENT UNIT CANNOT BE EMPTY'                          => 'الوحدة الحالة لا يمكن ان تكون فارغة',
        'JOINED DATE CANNOT BE EMPTY'                           => 'تاريخ الضم لا يمكن ان يكون فارغ',
        'DISCHARGE DATE CANNOT BE EMPTY'                        => 'تاريخ التسريح لا يمكن ان يكون فارغ',
        'ONE PHONE NUMBER IS REQUIRED'                          => 'مطلوب رقم تليفون علي الاقل',
        'ONE OR MORE FIELDS ARE REQUIRED'                       => 'يوجد حقل او اكثر لا يمكن ان يكونوا فارغين',
        'SOLDIER ADDED SUCCESSFULLY'                            => 'تم اضافة الجنــدى بنجــاح',
        'SOLDIER UPDATED SUCCESSFULLY'                          => 'تم تـعـديــل الجنــدى بنجــاح',
        'SOLDIER DELETED SUCCESSFULLY'                          => 'تم حـــذف الجنــدى بنجــاح',
        'SPECIALIZATION CANNOT BE EMPTY'                        => 'اسم التخصص لا يمكن ان يكون فارغ',
        'SPECIALIZATION ID CANNOT BE EMPTY'                     => 'رقم التخصص لا يمكن ان يكون فارغ',
        'SPECIALIZATION ADDED SUCCESSFULLY'                     => 'تـم اضــافة التخصـص بنجـاح',
        'SPECIALIZATION UPDATED SUCCESSFULLY'                   => 'تـم تعـديل التخصـص بنجـاح',
        'SPECIALIZATION DELETED SUCCESSFULLY'                   => 'تـم حــذف التخصـص بنجـاح',
        'YOU MUST CHOOSE A SPECIALIZATION'                      => 'لا بد من اختيار التخصص',
        'THERE IS NO ID LIKE THAT'                              => 'لا يـوجـد جنـدى بهذا الرقم',
        'THIS NAME IS EXIST'                                    => 'هــذا الاســم مـوجــود بالـفعــل',
        'THERE IS NO UNITS TO SHOW'                             => 'لا توجــد وحـــدات لـكى يـتم عرضـهـــــا',
        'THERE IS NO SOLDIERS TO SHOW'                          => 'لا توجـد جنود لكى يتم عرضها',
        'THERE IS NO SOLDIERS IN THIS UNIT TO SHOW'             => 'لا توجـد جنود علي قوة هذة الوحدة لكى يتم عرضها',
        'THERE IS A PROBLEM TO EXECUTE THE QUERY IN DATABASE'   => 'توجد مشكلة في تنفيذ الاستعلام داخل قاعدة البيانات',
        'ARE YOU SURE TO DELETE THIS SOLDIER?'                  => 'هل انت متأكد من حذف هذا الجندى؟',
        
        
        'WELCOME, THIS IS THE FIRST TIME YOU ARE LOGIN INTO THE SYSTEM' => 'مرحباً، هذا اول دخـول لك علي النظام',
        
        
        
        'DEVELOPED BY AHMED HASSIB'     => 'developed by ahmed hassib',
    );
    // return the word
    return $lang[$phrase];
}
