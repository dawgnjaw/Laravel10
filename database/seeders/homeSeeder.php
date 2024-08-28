<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class homeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('home_models')->insert([
            'name' => 'Nizar Ahza',
            'age' => '19',
            'adress' => 'Surabaya, JATIM',
        ]);
    }
}
