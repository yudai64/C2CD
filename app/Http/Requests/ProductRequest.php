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
            'product_name' => 'required',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'describe' => 'required',
            'category_id' => 'required',
        ];
    }

    public function attributes()
{
    return [
        'product_name' => '商品名',
        'price' => '価格',
        'amount' => '個数',
        'describe' => '詳細',
        'category_id' => 'カテゴリー'
    ];
}
}
