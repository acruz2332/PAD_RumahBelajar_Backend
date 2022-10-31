<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('akun')->insert([
            'username' => 'akbar.fajar2311',
            'password' => 'akbar123',
            'role' => 'guru',
            'email' => 'akbar.fajar2311@gmail.com',
        ]);
    }
}
