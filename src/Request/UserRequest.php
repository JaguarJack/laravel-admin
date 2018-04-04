<?php

namespace Lizyu\Admin\Reuqest;

use Illuminate\Validation\Rule;

class UserRequest extends Requests
{
    
    public function rules()
    {
        $table = config('auth.providers.' . config('auth.guards.admin.provider') . '.table');
        
        $sometimes = $this->id ? 'nullable|sometimes' : '|required';
        
        return [ 
            'name'     => ['required','min:2', 'max:15', Rule::unique($table)->ignore($this->id)],
            'email'    => ['email', Rule::unique($table)->ignore($this->id)],
            'password' => $sometimes . '|min:6|max:20|alpha_dash|confirmed',
        ];
    }
    
    
    public function messages()
    {
        return [
            'name.required'      => '用户名必须填写',
            'name.min'           => '用户名至少填写2个字符',
            'name.max'           => '用户名最大支持15个字符',
            'name.unique'        => '用户名已经被注册',
            'email.email'        => '邮箱填写不正确',
            'email.unique'       => '邮箱已经被注册',
            'password.required'  => '密码必须填写',
            'password.alpha_dash'=> '密码只支持字母、数字、破折号（ - ）以及下划线（ _ ）',
            'password.min'       => '密码最少需要填写六个字符',
            'password.max'       => '密码最大只支持20个字符',
            'password.confirmed' => '两次密码输入不一致',
        ];
    }
}