<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Cliente  extends Authenticatable
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['nome','sobrenome','senha','email','tipo','cnpj','cpf'];

    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
        ];
    }

    public function empreendimentos(){
        return $this->hasMany(Empreendimento::class);
    }

    public function empresas(){
        return $this->hasMany(Empresa::class);
    }

}
