<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('header_text')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('notes')->nullable();  
            $table->string('password')->nullable();
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->integer('course_id');
            $table->integer('user_id'); // whick is doctor
            $table->integer('minutes');  
            $table->integer('total');  
            $table->integer('question_number');  
            $table->boolean('required_password')->default(0);  
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
        Schema::dropIfExists('exams');
    }
}
