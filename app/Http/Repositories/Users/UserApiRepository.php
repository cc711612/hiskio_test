<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/9 上午 10:59
 */

namespace App\Http\Repositories\Users;

use App\Http\Repositories\Users\Contracts\UserApiRepositoryInterface;
use App\Http\Repositories\Abstracts\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserApiRepository extends RepositoryAbstract implements UserApiRepositoryInterface
{
    protected function getEntity(): Model
    {
        // TODO: Implement getEntity() method.
        if (app()->has(User::class) === false) {
            app()->singleton(User::class);
        }

        return app(User::class);
    }
}
