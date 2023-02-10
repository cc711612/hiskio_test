<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/9 上午 11:03
 */

namespace App\Http\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

abstract class RepositoryAbstract
{
    abstract protected function getEntity(): Model;

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

    public function create(array $Data)
    {
        return $this->getEntity()->create($Data);
    }

    abstract function getUserByEmail(string $email);
}
