<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Empresa extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['nome_da_empresa','cnpj','cep','endereço','Usuario_id','bairro','uf','cidade'];

    public function empreendimentos(){
        return $this->hasMany(Empreendimento::class);
    }

    public function usuario(){
        return $this->belongsTo(Cliente::class,'Usuario_id');
    }

}
