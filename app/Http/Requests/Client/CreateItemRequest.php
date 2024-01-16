<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'content' => 'required',
            'image' => 'required',
            'price' => 'required',
            'begin_date' => 'required',
            'end_date' => 'required',
            'category' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name' => 'name required',
            'content' => 'content required',
            'image' => 'image required',
            'price' => 'price required',
            'begin_date' => 'begin date required',
            'end_date' => 'end date required',
            'category' => 'category_id required',
        ];
    }
}
