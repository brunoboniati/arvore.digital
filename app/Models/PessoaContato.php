<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaContato extends Model
{
    use HasFactory;

    protected $table = 'pessoas_contatos';

    protected $fillable = [
        'descricao', 
        'pessoas_id',
        'tipo_contato_id' 
    ];
}
