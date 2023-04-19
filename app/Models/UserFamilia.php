<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserFamilia extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'users_familias';

    protected $fillable = [
        'user_id', 
        'familia_id', 
    ];

       /**
     * Log de ações do sistema
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }
    
    /**
     * Busca família que o usuário é adm
     */
    public function familia()
    {
       return $this->belongsTo(Familia::class, 'familia_id');        
    }

    /**
     * Busca usuer que é adm de família
     */
    public function user()
    {
       return $this->belongsTo(User::class, 'user_id');        
    }
}
