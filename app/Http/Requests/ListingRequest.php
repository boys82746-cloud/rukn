<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:60'],
            // Same 3–155 limit the SRS defines for a published post
            'description' => ['required', 'string', 'min:3', 'max:155'],
            'price' => ['required', 'integer', 'min:0', 'max:10000000'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'city' => ['required', 'string', Rule::in(config('marketplace.cities'))],
        ];
    }
}
