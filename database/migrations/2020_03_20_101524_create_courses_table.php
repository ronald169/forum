<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->enum('level', ['a1', 'a2', 'b1', 'b2', 'c1'])->default('a1');
            $table->integer('lesson')->default(1);
            $table->string('betreuung');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->bigInteger('visits')->default(0);
            $table->bigInteger('members_count')->default(0);
            $table->bigInteger('exercises_count')->default(0);
            $table->enum('class', ['6', '5', '4', '3', '2c', '2a', '2g', '1c', '1a', 'tc', 'ta', 'bacc+'])->default('3');
            $table->enum('matiere', ['mathematique', 'physique', 'chimie',
                        'histoire', 'geographie', 'ecm', 'anglais', 'francais', 'informatique',
                        'phylosophie', 'svt', 'autre'])
                        ->default('mathematique');

            $table->unsignedBigInteger('betreuung_id');
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
        Schema::dropIfExists('courses');
    }
}
