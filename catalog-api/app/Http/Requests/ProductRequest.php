<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique|max:255',
            'color' => 'required|max:255',
            'description' => 'required|unique:posts|max:255',
            'amount' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'color.required' => 'Color is required!',
            'description.required' => 'Description is required!',
            'amount.required' => 'Amount is required!',
        ];
    }
}
