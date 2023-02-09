<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Repositories\Users\UserApiRepository;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private $user_api_repository;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $user = User::factory()->create();
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    public function test_create_user_by_repository()
    {
        $name = Str::random(3);
        $email = sprintf("%s@test.com", Str::random(10));
        $password = Str::random(10);
        $User = $this->getUserApiRepository()
            ->create([
                'name'     => $name,
                'email'    => $email,
                'password' => $password,
            ]);
        $this->assertEquals($User->email, $email);
        $this->assertEquals($User->name, $name);
    }

    private function getUserApiRepository(): UserApiRepository
    {
        if (is_null($this->user_api_repository)) {
            $this->user_api_repository = app(UserApiRepository::class);
        }
        return $this->user_api_repository;
    }
}
