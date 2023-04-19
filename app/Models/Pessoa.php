<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Pessoa extends Model
{
    use HasFactory, Sluggable, LogsActivity;

    protected $fillable = [
        'pessoa_id',
        'nome_completo', 
        'genero', 
        'adotivo', 
        'pai_mae',
        'vivo',
        'nasc_dia',
        'nasc_mes',
        'nasc_ano',
        'nasc_local',
        'obt_dia',
        'obt_mes',
        'obt_ano',
        'obt_local',
        'observacoes',
        'nasc_latitude',
        'nasc_longitude',
        'obt_longitude',
        'obt_latitude',
        'user_id',
        'familia_id', 
    ];

    /**
     * Verifica se o slug é unico no banco
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nome_completo'
            ]
        ];
    }

    /**
     * Verifica se é a pessoa raiz da família
     */
    public function raiz()
    {
        if (is_null($this->pessoa)) {
            return true;
        }else{
            return false;
        }
    }

     /**
     * Contato da pessoa
     */
    public function contatos()
    {
        return $this->belongsToMany(TipoContato::class, 'pessoas_contatos')->withPivot('id','descricao')->withTimestamps();
    }
    
    /**
     * Busca pessoa de qual ela é descendente
     */
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class,'pessoa_id');
    }

    /**
     * Busca família da pessoa
     */
    public function familia()
    {
       return $this->belongsTo(Familia::class, 'familia_id');
        
    }

    /**
     * Define se a pessoa superior é o pai ou mãe da Pessoa
     */
    public function pai_ou_mae()
    {
        if (is_null($this->pessoa)) {
            return 'Primeira pessoa da família';
        }
        //se a pessoa superior for do sexo masculino (pai), entende-se que o conjuge é do sexo feminino (mãe)
        return $this->pessoa->genero==='M' ? 'Mãe' : 'Pai';
    }

    /**
     * Busca todos os irmão de uma Pessoa
     */
    public function irmaos()
    {
        if (is_null($this->pessoa_id)) {
            return collect([]);
        }

        return Pessoa::where('id', '!=', $this->id)
            ->where(function ($query) {
                if (!is_null($this->pessoa_id)) {
                    $query->where('pessoa_id', $this->pessoa_id);
                }

            })
            ->orderBy('nasc_ano')->get();
    }

    /**
     * Busca todos os filhos de uma Pessoa
     */
    public function filhos()
    {
        return Pessoa::where('id', '!=', $this->id)
            ->where(function ($query) {
                if (!is_null($this->id)) {
                    $query->where('pessoa_id', $this->id);
                }

            })
            ->orderBy('nasc_ano')->get();
    }


    /**
    * Retorna se o usuário logado é o coletor da pessoa
    */
    public function isTheOwner($user)
    {
        return $this->user_id === $user->id;
    }

     /**
     * Log de ações do sistema
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }

}
