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
    }
}
