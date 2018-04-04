<?php

namespace Lizyu\Admin\Reuqest;

use Illuminate\Validation\Rule;

class PermissionRequest extends Requests
{
    /**
     * @description:验证规则
     * @author wuyanwen(2018年4月4日)
     * @return string[]|string[][]|\Illuminate\Validation\Rules\Unique[][]
     */
    public function rules()
    {
        return [
            'name'     => ['required','min:2', 'max:15', Rule::unique('permissions')->ignore($this->id)],
            'url'      => 'required|min:2|max:30',
            'behavior' => 'required|behavior',
        ];
    }
    
    /**
     * 消息
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     */
    public function messages()
    {
        return [
            'name.required'      => '权限菜单必须填写',
            'name.min'           => '权限菜单至少填写2个字符',
            'name.max'           => '权限菜单最大支持15个字符',
            'name.unique'        => '权限菜单已存在',
            'url.required'       => '路由必须填写',
            'url.min'            => '路由至少两个字符',
            'url.max'            => '路由最长不超过三十个字符',
            'behavior.required'  => '菜单行为必须填写',
            'behavior.behavior'  => '菜单行为规则以controller@action形式',
        ];
    }
}