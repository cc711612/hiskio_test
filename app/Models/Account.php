<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/10 上午 11:26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    const Table = "accounts";

    protected $table = self::Table;

    protected $fillable = [
        'user_id',
        'account',
        'balance',
        'updated_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function balances()
    {
        return $this->hasMany(Balance::class, 'account_id', 'id');
    }
}
