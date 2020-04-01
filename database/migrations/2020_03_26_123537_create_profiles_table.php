<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('class', ['6', '5', '4', '3', '2c', '2a', '2g', '1c', '1a', 'tc', 'ta', 'bacc+'])->default('3');
            $table->string('school')->nullable();
            $table->string('phone')->nullable();
            $table->enum('fonction', ['student', 'professor'])->default('student');

            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('profiles');
    }
}
