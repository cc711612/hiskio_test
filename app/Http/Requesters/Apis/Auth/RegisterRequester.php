<?php

namespace App\Http\Requesters\Apis\Auth;

use App\Http\Requesters\Abstracts\RequestAbstract;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RegisterRequester extends RequestAbstract
{
    /**
     * @return null[]
     * @Author  : Roy
     * @DateTime: 2020/12/15 下午 03:02
     */
    protected function schema(): array
    {
        return [
            'email'          => null,
            'users.email'    => null,
            'password'       => null,
            'users.password' => null,
            'name'           => null,
            'users.name'     => null,
        ];
    }

    /**
     * @param $row
     *
     * @return array
     * @Author  : Roy
     * @DateTime: 2020/12/15 下午 03:02
     */
    protected function map($row): array
    {
        $name = explode("@", Arr::get($row, 'email'))[0];
        return [
            'email'          => Arr::get($row, 'email'),
            'users.email'    => Arr::get($row, 'email'),
            'password'       => Arr::get($row, 'password'),
            'users.password' => Arr::get($row, 'password'),
            'name'           => $name,
            'users.name'     => $name,
        ];
    }
}
