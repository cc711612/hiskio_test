<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/9 上午 12:42
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requesters\Apis\Auth\RegisterRequester;
use App\Http\Validators\Apis\Auth\RegisterValidator;
use Illuminate\Support\Facades\Log;
use App\Http\Services\Users\UserApiService;
use App\Http\Requesters\Apis\Auth\LoginRequester;
use App\Http\Validators\Apis\Auth\LoginValidator;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public $user_api_service;
    private $guard = 'api';

    public function __construct(UserApiService $apiService)
    {
        $this->user_api_service = $apiService;
        if (Auth::check()) {
            Auth::logout();
        }
    }

    public function login(Request $request)
    {
        $Requester = (new LoginRequester($request));

        $Validate = (new LoginValidator($Requester))->validate();
        if ($Validate->fails() === true) {
            return $this->response()->errorBadRequest($Validate->errors()->first());
        }
        try {
            $token = $this->user_api_service->login($Requester->users);
            if (is_null($token) === false && Auth::guard($this->guard)->check()) {
                return $this->response()->success([
                    'token_type'   => 'Bearer',
                    'access_token' => $token,
                    'expires_in'   => auth($this->guard)->factory()->getTTL() * 60,
                ]);
            }
        } catch (\Throwable $throwable) {
            Log::critical($throwable->getMessage());
        }
        return $this->response()->errorForbidden("帳號或密碼有誤");
    }

    public function register(Request $request)
    {
        $Requester = (new RegisterRequester($request));

        $Validate = (new RegisterValidator($Requester))->validate();
        if ($Validate->fails() === true) {
            return $this->response()->errorBadRequest($Validate->errors()->first());
        }
        try {
            $this->user_api_service->create($Requester->users);
            return $this->response()->success();
        } catch (\Throwable $throwable) {
            Log::critical($throwable->getMessage());
        }
        return $this->response()->fail("系統有誤");
    }
}
