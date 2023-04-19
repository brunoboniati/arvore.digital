<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas');
            $table->string("genero");
            $table->string("nome_completo");
            $table->string("adotivo");
            $table->string("pai_mae");
            $table->string("vivo");
            $table->string("nasc_dia")->nullable();
            $table->string("nasc_mes")->nullable();
            $table->string("nasc_ano")->nullable();
            $table->string("nasc_local")->nullable();
            $table->string("obt_dia")->nullable();
            $table->string("obt_mes")->nullable();
            $table->string("obt_ano")->nullable();
            $table->string("obt_local")->nullable();
            $table->string("observacoes")->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
