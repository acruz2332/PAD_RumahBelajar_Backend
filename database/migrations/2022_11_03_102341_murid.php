<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('murid', function (Blueprint $table){
            $table->string('token', 5)->primary()->unique();
            $table->string('username', 20);
            $table->foreign('username')->references('username')->on('akun');
            $table->string('nama');
            $table->text('tag_kelas');
            $table->text('nilai_quiz');
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::dropIfExist('murid');
    }
};
