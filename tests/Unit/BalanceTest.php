<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Balance;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BalanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_balance()
    {
        $balance = Balance::factory()->create();
        $this->assertDatabaseHas(Balance::class, [
            'id' => $balance->id,
        ]);
    }
}
