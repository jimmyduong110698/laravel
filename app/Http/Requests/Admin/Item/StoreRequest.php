<?php

namespace App\Http\Requests\Admin\Item;

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

    public function rules(): array
    {
        return [
            'name' => 'required|unique:items,name,'.$this->name,
            'price'=> 'required|numeric',
            'content' => 'required',
            'image' => 'required|mimes:jpg,bmp,png,jpeg',
            'begin_date' => 'required',
            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter product name',
            'name.unique' => 'Product name is exist. Please choose other product name',
            'price.required' => 'Please enter product price',
            'price.numeric' => 'Price is number',
            'content.required' => 'Please enter product description',
            'image.required' => 'Please enter product image',
            'image.mimes' => 'Images must jpg,bmp,png,jpeg',
            'begin_date.required' => 'Please enter start date.',
            'user_id.required' => 'Please enter user name.',
        ];
    }
}
