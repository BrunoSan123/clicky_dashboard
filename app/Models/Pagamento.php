<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable=['descrição','valor','pago','Contrato_id','data_de_vencimento','Usuario_id'];

    public function contrato(){
        return $this->belongsTo(Contrato::class,'Contrato_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class,'Usuario_id');
    }
}
