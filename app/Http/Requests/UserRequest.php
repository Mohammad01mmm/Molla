<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:8|max:12',
                'image' => 'mimes:png,jpg,jpeg,webp',
                'status' => 'required',
            ];
        }
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:12',
            'image' => 'mimes:png,jpg,jpeg,webp',
            'type' => 'required',
            'status' => 'required',
        ];
    }
}
