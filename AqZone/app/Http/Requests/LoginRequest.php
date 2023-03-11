<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "phoneNumber" => ["required", "string"],
            "password" => ["required"]
        ];
    }

    public function messages()
    {
        return [
            'phoneNumber' => 'Поле номер телефона обязательно к заполнению',
            'password' => [
                'required' => 'Пароль обязательно к заполнению',
            ]
        ];
    }
}
