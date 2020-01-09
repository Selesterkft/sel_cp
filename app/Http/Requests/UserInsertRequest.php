<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInsertRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'company_id' => 'required|not_in:0',
            //'password' => 'required|min:6|confirmed',
            'password' => 'nullable|min:6|required_with:password_confirmation|string|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'company_id' => [
                'required' => '',
            ],
        ];
    }
}
