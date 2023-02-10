<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 下午 08:38
 */

namespace App\Http\Repositories\Balances;

use App\Http\Repositories\Abstracts\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Models\Balance;

class BalanceApiRepository extends RepositoryAbstract
{
    protected function getEntity(): Model
    {
        // TODO: Implement getEntity() method.
        if (app()->has(Balance::class) === false) {
            app()->singleton(Balance::class);
        }

        return app(Balance::class);
    }

    public function createBalanceByAccountId(array $Data)
    {
        return $this->getEntity()->create($Data);
    }
}
