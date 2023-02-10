<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:34
 */

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requesters\Accounts\AccountShowRequester;
use App\Http\Presenters\Accounts\AccountShowPresenter;

class AccountController extends Controller
{
    public function index()
    {
        return view('accounts.index');
    }

    public function show(Request $request)
    {
        $Requester = (new AccountShowRequester($request));

        $Html = (new AccountShowPresenter())
            ->setResource('Requester', $Requester)
            ->genResponse()
            ->all();

        return view('accounts.show',compact('Html'));
    }
}
