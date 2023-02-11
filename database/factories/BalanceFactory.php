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
        $Account = Account::factory()->create();
        return [
            //
            'account_id' => $Account->id,
            'amount'     => $amount,
            'balance'    => function (array $attributes) use ($Account,$amount) {
                $Account->balance += $amount;
                $Account->save();
                return $Account->balance;
            },
        ];
    }
}
