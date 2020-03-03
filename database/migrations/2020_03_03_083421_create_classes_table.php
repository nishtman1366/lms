<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('professor_id');
            $table->unsignedBigInteger('lesson_id');
            $table->string('name');
            $table->timestamps();

            $table->index('professor_id');
            $table->index('lesson_id');

            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
