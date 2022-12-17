<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('akun', function (Blueprint $table){
            $table->string('username', 20)->primary()->unique();
            $table->string('password', 20);
            $table->enum('role', ['guru', 'murid']);
            $table->string('email');
        });
    }

    public function down()
    {
        Schema::dropIfExist('akun');
    }
};
