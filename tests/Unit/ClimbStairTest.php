<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Libraries\Recursion;

class ClimbStairTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_climb_stair()
    {
        $Recursion = (new Recursion());

        $this->assertEquals($Recursion->climbStairs(1), 1);
        $this->assertEquals($Recursion->climbStairs(2), 2);
        $this->assertEquals($Recursion->climbStairs(5), 8);
        $this->assertEquals($Recursion->climbStairs(6), 13);
        $this->assertEquals($Recursion->climbStairs(10), 89);
    }
}
