<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 上午 11:36
 */

namespace App\Http\Repositories\Accounts;

use App\Http\Repositories\Abstracts\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use Illuminate\Support\Collection;
use App\Models\Balance;

class AccountApiRepository extends RepositoryAbstract
{
    protected function getEntity(): Model
    {
        // TODO: Implement getEntity() method.
        if (app()->has(Account::class) === false) {
            app()->singleton(Account::class);
        }

        return app(Account::class);
    }

    public function get(): Collection
    {
        return $this->getEntity()->get();
    }

    public function show(int $account_id)
    {
        return $this->getEntity()
            ->select(['id', 'user_id', 'balance', 'updated_at'])
            ->with([
                Balance::Table => function ($query) {
                    return $query->select([
                        'id', 'account_id', 'amount', 'balance', 'created_at',
                    ])->orderByDesc('created_at');
                },
            ])
            ->find($account_id);
    }

    public function findForLockUpdate(int $account_id)
    {
        return $this->getEntity()
            ->select(['id', 'balance'])
            ->lockForUpdate()
            ->find($account_id);
    }
}
