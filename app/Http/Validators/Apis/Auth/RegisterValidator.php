<?php

namespace App\Http\Validators\Apis\Auth;

use App\Http\Validators\Abstracts\ValidatorAbstracts;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use App\Http\Requesters\Contracts\Request;

/**
 * Class RegisterValidator
 *
 * @package App\Http\Validators\Apis\Auth
 * @Author: Roy
 * @DateTime: 2022/6/21 上午 11:15
 */
class RegisterValidator extends ValidatorAbstracts
{

    protected $request;

    /**
     * @param  \App\Http\Requesters\Contracts\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \string[][]
     * @Author: Roy
     * @DateTime: 2021/7/30 下午 01:59
     */
    protected function rules(): array
    {
        return [
            'email'    => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'min:6',
                'max:18',
            ],
            'name'     => [
                'required',
            ],
        ];
    }

    /**
     * @return string[]
     * @Author: Roy
     * @DateTime: 2021/7/30 下午 01:59
     */
    protected function messages(): array
    {
        return [
            'password.required' => '密碼 為必填',
            'password.max'      => '密碼 至多18字元',
            'password.min'      => '密碼 至多6字元',
            'email.required'    => '帳號 為必填',
            'email.email'       => '帳號 格式為信箱',
            'email.unique'      => '帳號 已存在',
            'name.required'     => '暱稱 為必填',
        ];
    }
}
