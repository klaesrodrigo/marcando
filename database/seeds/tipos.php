<?php

use Illuminate\Database\Seeder;

class tipos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'tipo' => 'Futsal',
        ]);
        DB::table('tipos')->insert([
            'tipo' => 'Futsete',
        ]);
        DB::table('tipos')->insert([
            'tipo' => 'Society',
        ]);
        DB::table('tipos')->insert([
            'tipo' => 'Onze',
        ]);
        DB::table('tipos')->insert([
            'tipo' => 'Futareia',
        ]);
        DB::table('tipos')->insert([
            'tipo' => 'Volei areia',
        ]);
        DB::table('tipos')->insert([
            'tipo' => 'Volei',
        ]);
        DB::table('tipos')->insert([
            'tipo' => 'Basquete',
        ]);
        DB::table('tipos')->insert([
            'tipo' => 'Padel',
        ]);
    }
}
