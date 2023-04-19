<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Contato extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'chave', 
        'pessoa_id', 
        'tipo_contato_id', 
    ];

    /**
     * Log de ações do sistema
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }
}
