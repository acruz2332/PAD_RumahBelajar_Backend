<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table){
            $table->string('tokenMurid', 5);
            $table->string('tokenQuiz', 8);
            $table->foreign('tokenQuiz')->references('token')->on('quiz');
            $table->integer('count')->default(0);
            $table->integer('benar');
            $table->integer('salah');
            $table->integer('kosong');
            $table->float('nilai');
        });
    }

    public function down()
    {
        Schema::dropIfExist('nilai');
    }
};
