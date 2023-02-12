<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\JWT\JWTAuthTestCase;
use App\Models\Account;
use App\Models\Balance;
use App\Models\User;

class BalanceTest extends JWTAuthTestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_balance()
    {
        $user = User::factory()->create();
        $this->actingAs($user, $this->guard);
        $account = Account::factory()->create();
        $response = $this->post(route('api.balance.store', [
            'account_id' => $account->id,
        ]), [
            'amount' => rand(1, 1000),
            'type'   => Balance::BALANCE_TYPE_INCOME,
        ]);

        $data = json_decode($response->getContent(), 1);
        $this->assertEquals($data['status'], true);
    }
}
