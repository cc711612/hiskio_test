<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 下午 09:02
 */

namespace App\Http\Services\Abstracts;

use Illuminate\Support\Arr;

abstract class ServiceAbstract
{
    public $request = [];

    public function setRequest(array $request)
    {
        $this->request = $request;
        return $this;
    }

    public function isEmptyRequest(): bool
    {
        return empty($this->getRequest());
    }

    public function getRequest(): array
    {
        return $this->request;
    }

    public function getRequestByKey(string $key)
    {
        return Arr::get($this->getRequest(), $key);
    }

    public function getDefaultResult(): array
    {
        return [
            'status'  => false,
            'message' => null,
        ];
    }
}
