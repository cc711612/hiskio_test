<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitializationAccounts extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'accounts';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id')->comment('流水號');
            $table->integer('user_id')->unsigned()->unique()->commit('on users');
            $table->string('account', 64)->unique()->commit('帳號');
            $table->float('balance')->default(0)->commit('帳號');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::connection($this->connection)->statement("ALTER TABLE `{$this->table}` comment '使用者帳號存款資料表'");
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
