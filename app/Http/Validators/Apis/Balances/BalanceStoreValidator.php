<?php

namespace App\Http\Validators\Apis\Balances;

use App\Http\Validators\Abstracts\ValidatorAbstracts;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use App\Http\Requesters\Contracts\Request;

/**
 * Class BalanceStoreValidator
 *
 * @package App\Http\Validators\Apis\Balances
 * @Author: Roy
 * @DateTime: 2023/2/10 下午 08:43
 */
class BalanceStoreValidator extends ValidatorAbstracts
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
            'accounts.id'     => [
                'required',
                'exists:accounts',
            ],
            'balances.amount' => [
                'required',
                'numeric',
            ],
            'type'            => [
                'required',
                'in:1,2',
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
            'accounts.id.required'     => '系統發生錯誤',
            'accounts.id.exists'       => '系統發生錯誤',
            'balances.amount.required' => '金額為必填',
            'balances.amount.numeric'  => '金額為數字',
            'type.required'            => '類別為必填',
            'type.in'                  => '類別錯誤',
        ];
    }
}
