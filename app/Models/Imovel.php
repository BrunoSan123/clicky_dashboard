<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Imovel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['nome_do_imovel','cep','endereço','rua','uf','cidade','Unidade_id'];

    public function unidade(){
        return $this->belongsTo(Unidade::class,'Unidade_id');
    }
}
