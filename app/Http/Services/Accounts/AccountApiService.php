<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 下午 04:17
 */

namespace App\Http\Services\Accounts;

use App\Http\Repositories\Accounts\AccountApiRepository;
use Illuminate\Support\Collection;
use App\Http\Services\Abstracts\ServiceAbstract;

class AccountApiService extends ServiceAbstract
{
    public $account_repository;

    public function __construct(AccountApiRepository $accountApiRepository)
    {
        $this->account_repository = $accountApiRepository;
    }

    public function get(): Collection
    {
        return $this->account_repository->get();
    }

    public function show(int $account_id)
    {
        return $this->account_repository->show($account_id);
    }
}
