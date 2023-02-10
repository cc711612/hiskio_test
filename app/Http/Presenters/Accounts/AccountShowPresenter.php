<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 下午 04:48
 */

namespace App\Http\Presenters\Accounts;

use App\Http\Presenters\Abstracts\PresenterAbstract;
use Illuminate\Support\Arr;

class AccountShowPresenter extends PresenterAbstract
{
    public function genResponse()
    {
        $Requester = $this->getResource('Requester');
        $this->put('actions', [
            'account_uri' => route('api.account.show', [
                'account_id' => Arr::get($Requester, 'accounts.id'),
            ]),
            'balance_uri' => route('api.balance.store', [
                'account_id' => Arr::get($Requester, 'accounts.id'),
            ]),
        ]);
        return $this;
    }
}
