<?php

return [
    'required' => 'حقل :attribute مطلوب.',
    'string' => 'يجب أن يكون :attribute نصاً.',
    'email' => 'يجب أن يكون :attribute بريداً إلكترونياً صالحاً.',
    'unique' => ':attribute مستخدم من قبل.',
    'integer' => 'يجب أن يكون :attribute رقماً صحيحاً.',
    'numeric' => 'يجب أن يكون :attribute رقماً.',
    'exists' => ':attribute المحدد غير صالح.',
    'in' => ':attribute المحدد غير صالح.',
    'min' => [
        'numeric' => 'يجب ألا يقل :attribute عن :min.',
        'string' => 'يجب أن يتكون :attribute من :min أحرف على الأقل.',
    ],
    'max' => [
        'numeric' => 'يجب ألا يزيد :attribute عن :max.',
        'string' => 'يجب ألا يزيد :attribute عن :max حرفاً.',
    ],
    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'text' => 'نص الاقتباس',
        'category_id' => 'التصنيف',
    ],
];
