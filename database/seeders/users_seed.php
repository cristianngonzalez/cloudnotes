<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class users_seed extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        DB::table('users')->insert([
            'name' => 'Cristian Gonzalez',
            'email' => 'contact@cristianngonzalez.com',
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Andrea Gonzalez',
            'email' => 'andreafabianagonzalez1969@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
