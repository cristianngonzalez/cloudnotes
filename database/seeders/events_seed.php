<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class events_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('events')->insert([
            'user_id' => 1,
            'title' => 'Mi cumple',
            'start' => '2022-01-06',
            'end' => '2022-01-07',
            'editable' => true
        ]);

        DB::table('events')->insert([
            'user_id' => 2,
            'title' => 'Semana de la lujuria',
            'start' => '2023-01-13',
            'end' => '2023-01-20',
            'editable' => true
        ]);
    }
}
