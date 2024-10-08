<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Empreendimento extends Model implements HasMedia
{
    use HasFactory;
    use HasUuids;
    use InteractsWithMedia;

    protected $fillable=['nome_do_empreendimento','tipo','codigo','Usuario_id','Empresa_id','público','status','imagem'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($empreendimento) {
            // Gera um número aleatório para o campo 'codigo' se ele ainda não estiver definido
            $empreendimento->codigo = $empreendimento->codigo ?? rand(100000, 999999);
        });
    }


    public function usuario(){
        return $this->belongsTo(Cliente::class,'Usuario_id');
    }

    public function unidades(){
        return $this->hasMany(Unidade::class);
    }

    public function contrato(){
        return $this->hasOne(Contrato::class);
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class,'Empresa_id');
    }
}
