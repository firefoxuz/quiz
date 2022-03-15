<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTakeAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('take_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            $table->tinyInteger('active')->default(0);
            $table->text('content')->nullable();
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
        Schema::dropIfExists('take_answers');
    }
}
