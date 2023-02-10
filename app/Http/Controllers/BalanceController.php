<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:34
 */

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        return view('balances.index');
    }
}
