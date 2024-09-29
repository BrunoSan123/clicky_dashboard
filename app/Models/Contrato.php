<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Contrato extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['numero_do_contrato','nome_do_contratante','data_de_inicio','data_de_termino','valor_do_contrato','data_de_emissão','Empreendimento_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contrato) {
            // Gera um número aleatório para o campo 'codigo' se ele ainda não estiver definido
            $contrato->numero_do_contrato = $contrato->numero_do_contrato ?? rand(100000, 999999);
        });
    }
     
    public function empreendimento(){
        return $this->belongsTo(Empreendimento::class,'Empreendimento_id');
    }
}
