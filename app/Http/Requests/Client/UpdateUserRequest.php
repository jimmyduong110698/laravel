<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {   
        if (!empty($password)) {
            return [
                'password' => 'required|confirmed|min:8',
                'phone' => 'digits:10|unique:users,phone,'.Auth::user()->id,
            ];
        } else {
            return [
                'phone' => 'digits:10|unique:users,phone,'.Auth::user()->id,
            ];
        }
    }
    public function messages(): array
    {
        return [
            'phone.unique' => 'Phone number is exists',
            'password.confirmed' => 'Confirmation password does\'n match',
        ];
    }
}
