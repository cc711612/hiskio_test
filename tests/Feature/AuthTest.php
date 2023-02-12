<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_register()
    {
        $User = $this->getUserInfo();
        $email = Arr::get($User, 'email');
        $password = Arr::get($User, 'password');

        $response = $this->post(route('api.auth.register', [
            'email'    => $email,
            'password' => $password,
        ]));

        $response->assertStatus(200);
    }

    public function test_auth_login()
    {
        $User = $this->getUserInfo();
        $email = Arr::get($User, 'email');
        $password = Arr::get($User, 'password');

        $responseRegister = $this->post(route('api.auth.register', [
            'email'    => $email,
            'password' => $password,
        ]));

        $responseRegister->assertStatus(200);
        $responseLogin = $this->post(route('api.auth.login', [
            'email'    => $email,
            'password' => $password,
        ]));
        $responseLogin->assertStatus(200);
    }

    private function getUserInfo()
    {
        return [
            'email'    => $this->faker()->email,
            'password' => Str::random(10),
        ];
    }
}
