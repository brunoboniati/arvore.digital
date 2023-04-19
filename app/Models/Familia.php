<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Familia extends Model
{
    use HasFactory, Sluggable, LogsActivity;

    protected $fillable = [
        'nome_familia', 
        'descricao', 
        'slug',
        'pessoa_id', 
        'user_id', 
    ];

    /**
     * Verifica se o slug é unico no banco
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nome_familia'
            ]
        ];
    }

    /**
     * Log de ações do sistema
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }

    /**
     * Retorna pessoa raiz da família
     */
    public function raiz(): HasOne
    {
        return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
    }

    /**
    * Retorna administradores da familia
    */
    public function admin(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'users_familias')->wherePivot('adm', '1');
    }

     /**
     * Retorna se o usuário é administrador da Família
     */
    public function isAdminFamily($user)
    {
        $result = $this->belongsToMany(Familia::class, 'users_familias')->wherePivot('user_id', $user)->wherePivot('adm', '1')->get();
        //dd(count($result));
        if (count($result)) 
            return true;
        else
            return false;
    }

    /**
     * Retorna as pessoas de uma família
     */
    public function pessoas(): HasMany
    {
        return $this->hasMany(Pessoa::class);
    }

    /**
     * Retorna os usuários com permissão de coletar da família
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_familias','familia_id','user_id')->withPivot('id')->withTimestamps();
    }

}
