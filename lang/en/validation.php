<?php

return [
    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute must be text.',
    'email' => 'The :attribute must be a valid email address.',
    'unique' => 'This :attribute is already taken.',
    'integer' => 'The :attribute must be a whole number.',
    'numeric' => 'The :attribute must be a number.',
    'exists' => 'The selected :attribute is invalid.',
    'in' => 'The selected :attribute is invalid.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'string' => 'The :attribute may not be longer than :max characters.',
    ],
    'attributes' => [
        'name' => 'name',
        'email' => 'email',
        'password' => 'password',
        'text' => 'quote',
        'category_id' => 'category',
    ],
];
