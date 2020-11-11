<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepeatLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repeat_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('trx_id');
            $table->integer('plan_id');
            $table->string('amount');
            $table->dateTime('made_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repeat_logs');
    }
}
