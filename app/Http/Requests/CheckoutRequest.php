<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $emailValidation = auth()->user() ? 'required|email' : 'required|email|unique:users';

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => $emailValidation,
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'zip_code' => 'required|numeric',
            'tel' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'You already have an account with this email address. Please <a href="'.route('login').'">Login</a> to continue.',
        ];
    }

}
