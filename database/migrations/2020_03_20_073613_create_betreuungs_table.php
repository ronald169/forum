<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetreuungsTable extends Migration
{

    public function up()
    {
        Schema::create('betreuungs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('secret');
            $table->string('avatar')->nullable();
            $table->bigInteger('courses_count')->default(0);
            $table->bigInteger('members_count')->default(0);
            $table->bigInteger('visits')->default(0);

            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('betreuungs');
    }
}
