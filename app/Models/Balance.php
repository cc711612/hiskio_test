<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 上午 11:26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    const Table = "balances";

    protected $table = self::Table;

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
