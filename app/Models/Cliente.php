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

    protected $fillable=['nome','sobrenome','senha','email','tipo','cnpj','cpf','cidade','rua','pais'];

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

    public function endereços(){
        return $this->hasMany(Endereco::class,'Usuario_id');
    }

    public function pagamentos(){
        return $this->hasMany(Pagamento::class,'Usuario_id');
    }

    public function contratos(){
        return $this->hasMany(Contrato::class,'Usuario_id');
    }

    public function unidades(){
        return $this->hasMany(Unidade::class,'Usuario_id');
    }

}
