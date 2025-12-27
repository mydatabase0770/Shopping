<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    return [
        'title' => ['required', 'string', 'max:255'],

        'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],

        'description' => ['required', 'string', 'min:10'],

        'image' => [
            $this->isMethod('post') ? 'required' : 'nullable',
            'image',
            'mimes:jpeg,png,jpg,webp',
            'max:2048',
        ],

        'color' => ['required', 'string', 'max:50'],
        'discount' => ['nullable', 'numeric', 'max:50'],

        'size' => ['required', 'string', 'max:50'],

        'category_id' => ['required', 'array'],
        'category_id.*' => ['exists:categories,id'],
    ];
}

}
