<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

function getTokenMurid(){
    $char = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $token = '';

    for ($i=0; $i < 5; $i++){
        $index = rand(0, strlen($char)-1);
        $token .= $char[$index];
    }
    return $token;
}

class MuridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('murid')->insert([
            'token' => getTokenMurid(),
            'username' => 'antoniuswisnu',
            'nama' => 'Antonius K W A',
            'tag_kelas' => ' ',
            'nilai_quiz'=> ' ',
        ]);
    }
}
