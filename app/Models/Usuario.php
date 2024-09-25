<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Usuario extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['nome','sobrenome','senha','email','tipo'];

    public function empreendimentos(){
        return $this->hasMany(Empreendimento::class);
    }

}
