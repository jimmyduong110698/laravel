<?php

namespace App\Http\Requests\Admin\Withdraw;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest2 extends FormRequest
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
            'user_id' => 'required|numeric',
            'eth' => 'required|numeric',
            'vnd' => 'required|numeric',
            'account_number' => 'required',
            'account_name' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => 'Please enter user',
            'account_number.required' => 'Please enter account number',
            'account_name.required' => 'Please enter account name',
        ];
    }
}
