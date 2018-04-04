<?php

namespace Lizyu\Admin\Reuqest;

use Illuminate\Validation\Rule;

class RoleRequest extends Requests
{
    public function rules()
    {
        return [
            'name' => ['required','min:2', 'max:15', Rule::unique('roles')->ignore($this->id)],
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => '角色名称必须填写',
            'name.min'      => '角色名称必须最少2个字符',
            'name.max'      => '角色名称最大支持15个字符',
            'name.unique'   => '角色名称已经被注册',
        ];
    }
}