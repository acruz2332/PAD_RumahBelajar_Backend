<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

function getTokenGuru(){
    $char = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $token = '';

    for ($i=0; $i < 6; $i++){
        $index = rand(0, strlen($char)-1);
        $token .= $char[$index];
    }
    return $token;
}

class GuruSeeder extends Seeder
{

    public function run()
    {
        DB::table('guru')->insert([
            'token'    => getTokenGuru(),
            'username' => 'akbar.fajar2311',
            'nama' => 'Akbar Fajar Ramadhan',
            'tag_kelas' => ' ',
        ]);
    }
}
