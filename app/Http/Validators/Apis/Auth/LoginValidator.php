<?php

namespace App\Http\Validators\Apis\Auth;

use App\Http\Validators\Abstracts\ValidatorAbstracts;
use App\Http\Requesters\Contracts\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;


/**
 * Class LoginValidator
 *
 * @package App\Http\Validators\Api\Users
 * @Author: Roy
 * @DateTime: 2021/8/9 下午 04:16
 */
class LoginValidator extends ValidatorAbstracts
{
    /**
     * @var \App\Concerns\Databases\Contracts\Request
     */
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
            'password' => [
                'required',
                'min:6',
                'max:18',
            ],
            'email'    => [
                'required',
                'exists:users,email',
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
            'password.required' => 'password 為必填',
            'password.max'      => 'password 至多18字元',
            'password.min'      => 'password 至少6字元',
            'email.required'    => 'email 為必填',
            'email.exists'      => 'email not exist',
        ];
    }
}
