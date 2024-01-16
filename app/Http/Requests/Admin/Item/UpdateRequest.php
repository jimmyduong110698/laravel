<?php

namespace App\Http\Requests\Admin\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'price'=> 'required|numeric',
            'begin_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'begin_date.required' => 'Please enter start date.',
            'price.required' => 'Please enter product price.',
            'price.numeric' => 'Price is number.',
        ];
    }
}
