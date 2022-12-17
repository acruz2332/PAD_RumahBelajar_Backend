<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
function getTokenQuiz(){
    $char = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $token = '';

    for ($i=0; $i < 8; $i++){
        $index = rand(0, strlen($char)-1);
        $token .= $char[$index];
    }
    return $token;
}

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
    }
}