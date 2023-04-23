<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoContato extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'tipo_contato';

    protected $fillable = [
        'descricao', 
        'prefixo',
        'visivel' 
    ];

    /**
     * Log de ações do sistema
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }

     /**
     * Contato da pessoa
     */
    public function pessoas()
    {
        return $this->belongsToMany(Pessoas::class, 'pessoas_contatos')->withPivot('id','descricao')->withTimestamps();
    }
    
}
