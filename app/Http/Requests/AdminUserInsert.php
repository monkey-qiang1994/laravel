<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserInsert extends FormRequest
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
            //校验规则
            'ads_name'=>'required',
            'ads_position'=>'required'
        ];
    }

    public function messages()
    {
        return [
            //自定义错误信息
            'ads_name.required'=>'请添加图片说明',
            'ads_position.required'=>'请选择图片位置'
        ];
    }
}
