<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductInsert extends FormRequest
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
            //设置产品名不能为空
            'product_name'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'pics'=>'required',
        ];
    }

    //自定义错误消息
    public function messages(){
        return [
            'product_name.required'=>'产品名不能为空!',
            'price.required'=>'价格不能为空!',
            'price.numeric'=>'价格必须为数字!',
            'stock.required'=>'库存不能为空!',
            'stock.numeric'=>'库存必须为数字!',
            'pics.required'=>'图片不能为空!'
        ];
    }
}
