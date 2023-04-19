<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('familias')->insert([
            'nome_familia' => 'Wahlbrinck',
            'descricao' => '',
            'pessoa_id' => '1',
            'user_id' => '1',
        ]);

        DB::table('users_familias')->insert([
            'familia_id' => '1',
            'adm' => '1',
            'user_id' => '1',
        ]);
    }
}
