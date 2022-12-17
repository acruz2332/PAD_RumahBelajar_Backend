<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('guru', function (Blueprint $table){
            $table->string('token', 6)->primary()->unique();
            $table->string('username', 20);
            $table->foreign('username')->references('username')->on('akun');
            $table->string('nama');
            $table->string('tag_kelas');
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::dropIfExist('guru');
    }
};
