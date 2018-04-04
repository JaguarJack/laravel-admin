<?php

namespace Lizyu\Admin\Reuqest;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Lizyu\Admin\Traits\ResponseTrait;

class Requests extends FormRequest
{
    use ResponseTrait;
    
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
     *
     * @author:wuyanwen
     * @description:重写错误返回g
     * @date:2017年9月3日
     * @param Validator $validator
     * @return number[]|unknown[]
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->ajaxFail(current($validator->errors()->all())));
    }
}