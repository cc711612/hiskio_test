<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 上午 11:26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use SoftDeletes;

    const Table = "balances";

    protected $table = self::Table;

    const BALANCE_TYPE_INCOME = 1;
    const BALANCE_TYPE_EXPENSES = 2;

    protected $fillable = [
        'account_id',
        'amount',
        'balance',
        'updated_at',
    ];

    public function accounts()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

}
