<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        User::unsetEventDispatcher();
        return [
            //
            'user_id' => User::factory()->create()->id,
            'account' => Str::random(10),
            'balance' => 0,
        ];
    }
}
