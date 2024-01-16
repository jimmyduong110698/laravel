<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'nick_name' => 'required',
            'citizen_id' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed|min:8',
            'full_name' => 'required',
            'phone' => 'required|digits:10'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Please enter email',
            'email.unique' => 'Email is exist.Please choose other email',
            'email.email' => 'Email must be a valid email address.',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Confirmation password does\'n match',
            'password.min' => 'Password must be at least 8 chars',
            'full_name.required' => 'Please enter fullname',
            'phone.required' => 'Please enter phone',
            'nick_name.required' => 'Please enter nick name',
            'citizen_id.required' => 'Please enter citizen ID',
            'birthday.required' => 'Please enter birthday',
            'address.required' => 'Please enter address',
        ];
    }
}
