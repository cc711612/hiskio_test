<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitializationBalances extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'balances';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id')->comment('流水號');
            $table->integer('account_id')->unsigned()->comment('on account');
            $table->float('amount')->commit('金額');
            $table->float('balance')->commit('餘額');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        DB::connection($this->connection)->statement("ALTER TABLE `{$this->table}` comment '使用者存取款紀錄'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //刪除新的
        Schema::connection($this->connection)->dropIfExists($this->table);
    }
}
