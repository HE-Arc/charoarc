<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMatchs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger ('user_id1')->unsigned()->foreign('user_id1')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger ('user_id2')->unsigned()->foreign('user_id2')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('status_user1');
            $table->boolean('status_user2');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchs');
    }
}
