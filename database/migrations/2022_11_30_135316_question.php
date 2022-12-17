<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('question', function (Blueprint $table){
            $table->string('token', 8);
            $table->foreign('token')->references('token')->on('quiz');
            $table->text('question_list')->default(NULL);
            $table->text('answer_list')->default(NULL);
            $table->text('jawaban')->default(NULL);
        });
    }

    public function down()
    {
        Schema::dropIfExist('question');
    }
};
?>