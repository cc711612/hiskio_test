<?php

namespace App\Http\Resources\Accounts;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Account;
use App\Models\Balance;

class AccountApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function index()
    {
        return $this->resource->map(function (Account $account) {
            return [
                'id'      => $account->id,
                'user_id' => $account->user_id,
                'account' => $account->account,
                'balance' => number_format($account->balance),
                'actions' => [
                    'show_uri' => route('account.show', [
                        'account_id' => $account->id,
                    ]),
                ],
            ];
        });
    }

    public function show()
    {
        return [
            'id'         => $this->resource->id,
            'user_id'    => $this->resource->user_id,
            'balance'    => $this->resource->balance,
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
            'balances'   => $this->resource->balances->map(function (Balance $balance) {
                return [
                    'id'         => $balance->id,
                    'amount'     => $balance->amount,
                    'balance'    => $balance->balance,
                    'account_id' => $balance->account_id,
                    'created_at' => $balance->created_at->toDateTimeString(),
                ];
            }),
        ];
    }
}
