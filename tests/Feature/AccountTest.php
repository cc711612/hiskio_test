<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Account;
use Tests\Feature\JWT\JWTAuthTestCase;

class AccountTest extends JWTAuthTestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_accounts()
    {
        $user = User::factory()->create();
        $this->actingAs($user, $this->guard);
        $response = $this->get(route("api.account.index"));
        $data = json_decode($response->getContent(), 1);
        $this->assertEquals($data['status'], true);
    }

    public function test_show_accounts()
    {
        $user = User::factory()->create();
        $this->actingAs($user, $this->guard);
        $Account = Account::factory()->create();
        $response = $this->get(route("api.account.show", ['account_id' => $Account->id]));
        $data = json_decode($response->getContent(), 1);
        $this->assertEquals($data['status'], true);
    }
}
