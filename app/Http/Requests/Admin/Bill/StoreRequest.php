<?php

namespace App\Http\Requests\Admin\Bill;

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
            'user_id' => 'required|numeric',
            'eth' => 'required|numeric',
            'vnd' => 'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => 'Please enter user',
        ];
    }
}
