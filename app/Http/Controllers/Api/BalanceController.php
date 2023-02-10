<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:34
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends ApiController
{
    public function index(Request $request)
    {
        return $this->response()->success([]);
    }
}
