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
     
    public function empreendimento(){
        return $this->belongsTo(Empreendimento::class);
    }
}
