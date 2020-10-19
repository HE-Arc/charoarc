<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('person', function (Blueprint $table) {
        $table->id();
        $table->string('nickname', 100);
        $table->string('email',100);
        $table->string('password', 255);
        $table->date('age');
        $table->string('gender', 20);
        $table->string('interessed_by', 20);
        $table->string('picture_path', 255);
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
        Schema::dropIfExists('person');
    }
}
