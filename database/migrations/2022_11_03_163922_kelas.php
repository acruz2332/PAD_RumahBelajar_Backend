<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table){
            $table->string('token', 7)->primary()->unique();
            $table->string('ikon')->default(NULL)->nullable();
            $table->string('nama_kelas', 30);
            $table->text('list_murid');
        }); 
    }

    public function down()
    {
        Schema::dropIfExist('kelas');
    }
};
