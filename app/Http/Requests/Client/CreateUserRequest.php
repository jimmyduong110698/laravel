<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'full_name' => 'required',
            'nick_name' => 'required',
            'citizen_id' => 'required|unique:users,citizen_id|digits:12',
            'phone' => 'required|unique:users,phone|digits:10',
            'addresss' => 'required',
            'date_of_birth' => 'required',
            'content' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'email required',
            'email.unique' => 'Email name is exists',
            'citizen_id.unique' => 'Citizen ID name is exists',
            'phone.unique' => 'Phone is exists',
            'password.confirmed' => 'Confirmation password does\'n match',
            'full_name.required' => 'full name required',
            'citizen_id.required' => 'citizen id required',
            'phone.required' => 'phone required',
            'addresss.required' => 'addresss required',
            'date_of_birth.required' => 'date_of_birth required',
        ];
    }
}
