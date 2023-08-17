<?php

namespace App\Http\Requests\Auth;

use App\Helpers\RedirectHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AuthLoginRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator) {RedirectHelper::failedValidation($validator); }
}
