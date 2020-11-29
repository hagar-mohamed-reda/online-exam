<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text');
            $table->integer('question_type_id');
            $table->integer('course_id');
            $table->integer('user_id');
            $table->float('default_grade')->default(0);
            $table->boolean('is_sharied')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('auto_correct')->default(0);
            $table->integer('max_answer_characters')->default(0);
            $table->string('photo')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('questions');
    }
}
