<?php

namespace App\Http\Requesters\Apis\Balances;

use Illuminate\Support\Arr;
use App\Http\Requesters\Abstracts\RequestAbstract;

class BalanceStoreRequester extends RequestAbstract
{
    /**
     * @return null[]
     * @Author  : Roy
     * @DateTime: 2020/12/15 下午 03:02
     */
    protected function schema(): array
    {
        return [
            'accounts.id'         => null,
            'balances.account_id' => null,
            'balances.amount'     => null,
            'type'                => 1,
        ];
    }

    /**
     * @param $row
     *
     * @return array
     * @Author  : Roy
     * @DateTime: 2020/12/15 下午 03:02
     */
    protected function map($row): array
    {
        return [
            'accounts.id'         => Arr::get($row, 'account_id'),
            'balances.account_id' => Arr::get($row, 'account_id'),
            'balances.amount'     => Arr::get($row, 'amount'),
            'type'                => Arr::get($row, 'type'),
        ];
    }

}
