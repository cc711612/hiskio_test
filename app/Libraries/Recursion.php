<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/12 下午 05:19
 */

namespace App\Libraries;

class Recursion
{
    function climbStairs($n)
    {
        if ($n <= 2) {
            return $n;
        } else {
            return $this->climbStairs($n - 1) + $this->climbStairs($n - 2);
        }
    }
}
