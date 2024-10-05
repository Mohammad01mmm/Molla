<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'title' => 'required|max:255',
                'description' => 'required',
                'main_property' => 'required',
                'main_property[*]' => 'required',
                'properties' => 'required',
                'properties.*' => 'required',
                'unit.*' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg,webp',
                'status' => 'required',
            ];
        }
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'main_property' => 'required',
            'main_property[*]' => 'required',
            'properties' => 'required',
            'properties.*' => 'required',
            'unit.*' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp',
            'status' => 'required',
            
        ];
    }
}
