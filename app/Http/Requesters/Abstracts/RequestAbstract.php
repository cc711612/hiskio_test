<?php

namespace App\Http\Requesters\Abstracts;

use App\Http\Requesters\Contracts\Request as RequestContract;
use ArrayAccess;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class RequestAbstract
 *
 * @package App\Http\Requesters\Abstracts
 * @Author: Roy
 * @DateTime: 2023/2/9 上午 10:47
 */
abstract class RequestAbstract implements ArrayAccess, RequestContract
{
    /**
     * @var
     */
    protected $attributes;
    /**
     * @var
     */
    protected $schema;
    /**
     * @var
     */
    protected $sources;
    /**
     * @var
     */
    private $collection;

    /**
     * @var bool
     */
    private $is_collection = false;

    /**
     * @param $sources
     */
    public function __construct($sources)
    {
        // 如果來源是
        if ($sources instanceof Collection) {
            $this->collection($sources);
            return;
        }

        $this->sources = $sources;
        $this->initialization();
    }

    /**
     * @param  \Illuminate\Support\Collection  $collection
     *
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:47
     */
    private function collection(Collection $collection)
    {
        $this->is_collection = true;
        $this->collection = $collection->map(function ($item) {
            return new static($item);
        });
    }

    /**
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:47
     */
    private function initialization()
    {
        $this->schema = $this->schema();
        foreach ($this->solveAttribute() as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return array
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:47
     */
    abstract protected function schema(): array;

    /**
     * @return array
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:47
     */
    private function solveAttribute(): array
    {
        return $this->array_merge_default($this->map($this->sources), $this->schema);
    }

    /**
     * @param $row
     *
     * @return array
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:47
     */
    abstract protected function map($row): array;

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * @param $key
     * @param $value
     *
     * @Author: Roy
     * @DateTime: 2022/9/15 上午 12:16
     */
    public function __set($key, $value): void
    {
        $this->setAttribute($key, $value);
    }

    /**
     * @param  string  $key
     *
     * @return array|\ArrayAccess|mixed
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:47
     */
    protected function getAttribute(string $key)
    {
        return Arr::get($this->attributes, $key);
    }

    /**
     * @param  string  $key
     * @param $value
     *
     * @return array
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:47
     */
    protected function setAttribute(string $key, $value): array
    {
        return Arr::set($this->attributes, $key, $value);
    }

    /**
     * Determine if an attribute or relation exists on the model.
     *
     * @param  string  $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Determine if the given attribute exists.
     *
     * @param  mixed  $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $this->getAttribute($offset) !== null;
    }

    /**
     * Unset an attribute on the model.
     *
     * @param  string  $key
     *
     * @return void
     */
    public function __unset($key)
    {
        $this->offsetUnset($key);
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  mixed  $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    /**
     * @return bool
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:48
     */
    public function isCollection(): bool
    {
        return $this->is_collection;
    }

    /**
     * Get the value for a given offset.
     *
     * @param  mixed  $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->getAttribute($offset);
    }

    /**
     * Set the value for a given offset.
     *
     * @param  mixed  $offset
     * @param  mixed  $value
     *
     * @return array
     */
    public function offsetSet($offset, $value): array
    {
        return $this->setAttribute($offset, $value);
    }

    /**
     * @return array
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 10:48
     */
    public function toArray(): array
    {
        if ($this->collection instanceof Collection) {
            return $this->collection->map(function (RequestContract $Request) {
                return $Request->toArray();
            })->toArray();
        }
        return $this->attributes;
    }

    function array_merge_default(array $sources, array $defaults): array
    {
        return array_replace($defaults, array_intersect_key(
                array_filter($sources, function ($value) {
                    return !is_null($value);
                }),
                $defaults)
        );
    }
}
