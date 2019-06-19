<?php

use Illuminate\Database\Seeder;

class clientes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'nome' => 'José Araujo',
            'cpf' => '12345678912',
            'telefone' => '5553984563214',
            'email' => 'josearaujo@email.com'
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Diego Macedo',
            'cpf' => '65432198748',
            'telefone' => '5553981558475',
            'email' => 'diegomacedo@email.com'
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Rodrigo Klaes',
            'cpf' => '25814736963',
            'telefone' => '5553999586536',
            'email' => 'rodrigoklaes@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Roberta Soares',
            'cpf' => '15915615323',
            'telefone' => '555322365487',
            'email' => 'robertasoares@email.com'
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Gabriel Silva',
            'cpf' => '25847625422',
            'telefone' => '555399955416',
            'email' => 'gabrielsilva@email.com'
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Camila Santana',
            'cpf' => '25814736963',
            'telefone' => '5553999586536',
            'email' => 'rodrigo_klae2@hotmail.com'
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Edécio Iepsem',
            'cpf' => '1122253364',
            'telefone' => '55539985652236',
            'email' => 'edeciofernando@gmail.com'
        ]);
    }
}
