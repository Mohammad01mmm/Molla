<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname' => 'required|regex:/^[\p{Arabic}،ء-ي\s]+$/u|min:3',
            'lname' => 'required|regex:/^[\p{Arabic}،ء-ي\s]+$/u|min:3',
            'city' => 'required|regex:/^[\p{Arabic}،ء-ي\s]+$/u|min:3',
            'address' => 'required',
            'zip_code' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email'
        ];
    }
}
