<?php

namespace App\Http\Validators\Apis\Accounts;

use App\Http\Validators\Abstracts\ValidatorAbstracts;
use App\Http\Requesters\Contracts\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;


/**
 * Class AccountShowValidator
 *
 * @package App\Http\Validators\Apis\Accounts
 * @Author: Roy
 * @DateTime: 2023/2/10 下午 05:27
 */
class AccountShowValidator extends ValidatorAbstracts
{
    /**
     * @var \App\Http\Requesters\Contracts\Request
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
            'accounts.id' => [
                'required',
                'exists:accounts',
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
            'accounts.id.required' => '參數有誤',
            'accounts.id.exists'   => '參數有誤',
        ];
    }
}
