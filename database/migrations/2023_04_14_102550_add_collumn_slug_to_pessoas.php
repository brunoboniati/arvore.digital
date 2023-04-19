<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pessoa;
use Illuminate\Support\Str;


class AddCollumnSlugToPessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->string('slug')->default();
        });

         $pessoas = Pessoa::all();

         foreach($pessoas as $pessoa)
         {
            $pessoa->slug = Str::slug($pessoa->nome_completo,'-');
            $pessoa->save();
         }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            //
        });
    }
}
