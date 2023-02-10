<?php

namespace App\Http\Requesters\Accounts;

use Illuminate\Support\Arr;
use App\Http\Requesters\Abstracts\RequestAbstract;

class AccountShowRequester extends RequestAbstract
{
    /**
     * @return null[]
     * @Author  : Roy
     * @DateTime: 2020/12/15 下午 03:02
     */
    protected function schema(): array
    {
        return [
            'accounts.id' => null,
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
            'accounts.id' => Arr::get($row, 'account_id'),
        ];
    }

}
