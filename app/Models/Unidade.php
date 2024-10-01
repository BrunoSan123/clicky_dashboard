<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Unidade extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['nome_da_unidade','quantidade','cnpj','região','Empreendimento_id'];


    public function empreendimento(){
        return $this->belongsTo(Empreendimento::class,'Empreendimento_id');
    }

}
