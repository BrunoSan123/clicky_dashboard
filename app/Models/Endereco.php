<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Endereco extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable=['rua','cep','cidade','pais','Usuario_id'];

    public function usuario(){
        return $this->belongsTo(Cliente::class,'Usuario_id');
    }
}
