<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6|required_with:passconf|same:passconf',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password is required to update user profile.',
        ];
    }

    public function attributes()
    {
        return [
            'passconf' => 'password confirmation',
        ];
    }
}
