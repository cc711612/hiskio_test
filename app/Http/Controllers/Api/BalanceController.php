<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:34
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Services\Accounts\AccountApiService;
use App\Http\Resources\Accounts\AccountApiResource;
use App\Http\Services\Balances\BalanceApiService;
use App\Http\Requesters\Apis\Balances\BalanceStoreRequester;
use App\Http\Validators\Apis\Balances\BalanceStoreValidator;
use Illuminate\Support\Facades\Log;

class BalanceController extends ApiController
{
    public $balance_api_service;

    public function __construct(BalanceApiService $balanceApiService)
    {
        $this->balance_api_service = $balanceApiService;
    }

    public function store(Request $request)
    {
        $Requester = (new BalanceStoreRequester($request));

        $Validate = (new BalanceStoreValidator($Requester))->validate();
        if ($Validate->fails() === true) {
            return $this->response()->errorBadRequest($Validate->errors()->first());
        }
        $message = "系統發生問題，請重新整理";
        try {
            $Result = $this->balance_api_service
                ->setRequest($Requester->toArray())
                ->store();
            if ($Result['status']) {
                return $this->response()->success([]);
            }
            $message = $Result['message'];
            return $this->response()->errorBadRequest($Result['message']);
        } catch (\Throwable $throwable) {
            Log::critical($throwable->getMessage());
        }
        return $this->response()->errorBadRequest($message);
    }
}
