<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:34
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Services\Accounts\AccountApiService;
use App\Http\Resources\Accounts\AccountApiResource;
use App\Http\Requesters\Accounts\AccountShowRequester;
use App\Http\Validators\Apis\Accounts\AccountShowValidator;
use Illuminate\Support\Facades\Log;

class AccountController extends ApiController
{
    public $account_api_service;

    public function __construct(AccountApiService $accountApiService)
    {
        $this->account_api_service = $accountApiService;
    }

    public function index()
    {
        try {
            return $this->response()->success((new AccountApiResource($this->account_api_service->get()))->index());
        } catch (\Throwable $throwable) {
            Log::critical($throwable->getMessage());
        }
        return $this->response()->errorInternal("系統發生問題，請重新整理");
    }

    public function show(Request $request)
    {
        $Requester = (new AccountShowRequester($request));
        $Validate = (new AccountShowValidator($Requester))->validate();
        if ($Validate->fails() === true) {
            return $this->response()->errorBadRequest($Validate->errors()->first());
        }
        try {
            $Data = (new AccountApiResource(
                $this->account_api_service->show(Arr::get($Requester, 'accounts.id'))
            ))
            ->show();
            return $this->response()->success($Data);
        } catch (\Throwable $throwable) {
            Log::critical($throwable->getMessage());
        }
        return $this->response()->errorInternal("系統發生問題，請重新整理");
    }
}
