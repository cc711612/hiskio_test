<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 下午 08:39
 */

namespace App\Http\Services\Balances;

use App\Http\Repositories\Balances\BalanceApiRepository;
use App\Http\Repositories\Accounts\AccountApiRepository;
use App\Http\Services\Abstracts\ServiceAbstract;
use App\Models\Balance;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BalanceApiService extends ServiceAbstract
{
    public $balance_repository;

    public $account_repository;

    public function __construct(
        BalanceApiRepository $balanceApiRepository,
        AccountApiRepository $accountApiRepository
    ) {
        $this->balance_repository = $balanceApiRepository;
        $this->account_repository = $accountApiRepository;
    }

    public function store()
    {
        $Result = $this->getDefaultResult();
        $Account = $this->account_repository
            ->findForLockUpdate($this->getRequestByKey('accounts.id'));
        $amount = floatval($this->getRequestByKey('balances.amount'));
        if ($this->getRequestByKey('type') == Balance::BALANCE_TYPE_EXPENSES && ($Account->balance < $amount)) {
            Arr::set($Result, 'message', '餘額不足');
            return $Result;
        }
        try {
            DB::transaction(function () use ($Account, $amount) {
                switch ($this->getRequestByKey('type')) {
                    case Balance::BALANCE_TYPE_EXPENSES:
                        $Account->decrement('balance', $amount);
                        break;
                    case Balance::BALANCE_TYPE_INCOME:
                        $Account->increment('balance', $amount);
                        break;
                    default:
                        throw new \Exception("類別發生錯誤");
                }
                $Account->save();
                $this->balance_repository->createBalanceByAccountId([
                    'account_id' => $this->getRequestByKey('balances.account_id'),
                    'amount'     => $this->getRequestByKey('type') == Balance::BALANCE_TYPE_EXPENSES ? 0 - $this->getRequestByKey('balances.amount') : $this->getRequestByKey('balances.amount'),
                    'balance'    => $Account->balance,
                ]);
            });
            Arr::set($Result, 'status', true);
        } catch (\Throwable $throwable) {
            Log::critical($throwable->getMessage());
            Arr::set($Result, 'message', '系統發生有誤');
        }
        return $Result;
    }
}
