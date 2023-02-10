<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/9 上午 11:29
 */

namespace App\Http\Services\Users;

use App\Http\Repositories\Users\UserApiRepository;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use App\Http\Services\Abstracts\ServiceAbstract;

class UserApiService extends ServiceAbstract
{
    public $user_repository;

    private $guard = 'api';

    public function __construct(
        UserApiRepository $userApiRepository,
    ) {
        $this->user_repository = $userApiRepository;
    }

    public function create($Data): void
    {
        $userEntity = $this->user_repository->create($Data);
        $userEntity->accounts()->firstOrCreate([
            'user_id' => $userEntity->id,
            'account' => sprintf("%s%s", Str::random(10), $userEntity->id),
        ]);
    }

    public function login($Data): string|null
    {
        $user = $this->user_repository->getUserByEmail($Data['email']);
        #認證失敗
        if (!Auth::guard($this->guard)->attempt($Data)) {
            return null;
        }
        return JWTAuth::fromUser($user);
    }
}
