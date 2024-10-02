<?php

namespace App\Livewire;

use App\Models\Empreendimento;
use App\Models\Imovel;
use App\Models\Unidade;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Empreendimento_Status extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Empreendimentos', count(Empreendimento::all())),
            Stat::make('Unidades', count(Unidade::all())),
            Stat::make('Unidades', count(Imovel::all())),

        ];
    }

}
