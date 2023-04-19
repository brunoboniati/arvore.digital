<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pessoas')->insert([
            'pessoa_id' => null,
            'genero' => 'M',
            'nome_completo' => Str::random(10),
            'adotivo' => '1',
            'pai_mae' => Str::random(10),
            'vivo' => '1',
            'nasc_dia' => '11' ,
            'nasc_mes' => '11' ,
            'nasc_ano' => '1943' ,
            'nasc_local' => Str::random(10),
            'obt_dia' => '04' ,
            'obt_mes' => '02' ,
            'obt_ano' => '1952' ,
            'obt_local' => Str::random(10),
            'observacoes' => Str::random(10),
            'user_id' => '1',
        ]);
    }
}
