<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_account()
    {
        $account = Account::factory()->create();
        $this->assertDatabaseHas(Account::Table, [
            'id' => $account->id,
        ]);
    }
}
