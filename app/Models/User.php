<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'ativo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function familias(): BelongsToMany
    {
        return $this->BelongsToMany(Familia::class, 'users_familias', 'user_id', 'familia_id')->withPivot('id')->withTimestamps();
    }

    /**
     * Retorna se o usuário é admin
     */
    public function isAdmin()
    {
        if ($this->tipo=='1') {
            return true;
        }
        return false;
    }

     /**
     * Retorna se o usuário esta ativo
     */
    public function isActive()
    {
        return $this->ativo;
    }

    /**
     * Retorna se o usuário é administrador da Família
     */
    public function isAdminFamily($familia)
    {
        $result = $this->belongsToMany(Familia::class, 'users_familias')->wherePivot('familia_id', $familia->id)->wherePivot('adm', '1')->get();
        //dd(count($result));
        if (count($result)) 
            return true;
        else
            return false;
    }

       /**
     * Log de ações do sistema
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }
}
