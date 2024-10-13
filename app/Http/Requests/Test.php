<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Test extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:25', 'unique:products,name'],
            'price' => ['required', 'numeric'],
            'image' => ['image', 'mimes:png,jpg,jpeg'],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'categpryId' => ['required', 'exists:categories,id'],
            'brandId' => ['required', 'exists:brands,id'],
        ];
    }
}
