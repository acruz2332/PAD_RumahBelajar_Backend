<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table){
            $table->string('token', 8)->primary()->unique();
            $table->string('mata_pelajaran', 30);
            $table->string('nama_quiz', 30);
            $table->text('tag_kelas');
        }); 
    }

    public function down()
    {
        Schema::dropIfExist('quiz');
    }
};
