<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Balance;
use App\Models\Account;

class BalanceFactory extends Factory
{
    protected $model = Balance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = rand(-100, 100);
        return [
            //
            'account_id' => Account::factory()->create(),
            'amount'     => $amount,
            'balance'    => 0,
        ];
    }
}
