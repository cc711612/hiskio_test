<?php
/**
 * @Author: Roy
 * @DateTime: 2021/8/12 下午 09:04
 */

namespace App\Traits;


use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiPaginateTrait
{
    /**
     * @param  \Illuminate\Pagination\LengthAwarePaginator  $collection
     *
     * @return array
     * @Author: Roy
     * @DateTime: 2023/2/9 上午 12:43
     */
    public function handleApiPageInfo(LengthAwarePaginator $collection): array
    {
        $format = [
            'current_page',
            'last_page',
            'per_page',
            'total',
        ];

        return Arr::only($collection->toArray(), $format);
    }
}

