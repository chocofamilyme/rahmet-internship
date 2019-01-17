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
            'name' => [
                'required',
                'min:3',
                'max:255',
            ],
            'description' => [
                'required',
                'min:3',
            ],
            'color' => [
                // 'required',
                'min:3',
            ],
            'price' => [
                // 'required',
                'numeric',
                'between:0.01,9999.99'
            ],
            'weight' => [
                // 'required',
                'numeric',
                'between:0.001,999.999'
            ]
        ];
    }
}
