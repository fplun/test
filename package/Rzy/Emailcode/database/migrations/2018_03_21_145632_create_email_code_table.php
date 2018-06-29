<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('code', 10);
            $table->tinyInteger('status')->default(0);
            $table->string('ip', 32);
            $table->string('result', 128);
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
        Schema::dropIfExists('email_code');
    }
}
