<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Empreendimento extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['nome_do_empreendimento','tipo','codigo','Usuario_id'];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function contrato(){
        return $this->hasOne(Contrato::class);
    }
}
