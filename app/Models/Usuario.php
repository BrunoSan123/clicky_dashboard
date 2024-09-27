<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class Usuario  extends Authenticatable
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['name','sobrenome','password','email','tipo'];

    public function empreendimentos(){
        return $this->hasMany(Empreendimento::class);
    }

    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return true;
    // }

}
