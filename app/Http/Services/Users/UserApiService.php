<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/9 上午 11:29
 */

namespace App\Http\Services\Users;

use App\Http\Repositories\Users\UserApiRepository;
use Illuminate\Support\Facades\Auth;

class UserApiService
{
    public $user_repositry;

    private $guard = 'web';

    public function __construct(UserApiRepository $userApiRepository)
    {
        $this->user_repositry = $userApiRepository;
    }

    public function create($Data)
    {
        return $this->user_repositry->create($Data);
    }

    public function login($Data): bool
    {
        #認證失敗
        if (!Auth::guard($this->guard)->attempt($Data)) {
            return false;
        }
        return true;
    }
}
