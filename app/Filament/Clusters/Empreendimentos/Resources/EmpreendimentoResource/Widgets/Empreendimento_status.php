<?php

namespace App\Filament\Clusters\Empreendimentos\Resources\EmpreendimentoResource\Widgets;

use App\Models\Empreendimento;
use App\Models\Imovel;
use App\Models\Unidade;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Empreendimento_status extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Empreendimentos', count(Empreendimento::all())),
            Stat::make('Unidades', count(Unidade::all())),
            Stat::make('Imóveis', count(Imovel::all())),

        ];
    }
}
