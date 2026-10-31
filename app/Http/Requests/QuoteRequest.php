<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            // The 3–155 character limit defined by the SRS
            'text' => ['required', 'string', 'min:3', 'max:155'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
