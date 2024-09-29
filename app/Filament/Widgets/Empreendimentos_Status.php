<?php

namespace App\Filament\Widgets;

use App\Models\Empreendimento;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class Empreendimentos_Status extends BaseWidget
{
    protected function getStats(): array
    {
        $dataUltimos30Dias = Empreendimento::where('created_at', '>=', Carbon::now()->subDays(30))
        ->orderBy('created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d'); // Agrupando por dia
        });

        // Criando um array para contar contratos por dia
        $contratosPorDia = [];
        for ($i = 1; $i <= 30; $i++) {
            $dia = Carbon::now()->subDays(30 - $i)->format('d');
            $contratosPorDia[] = $dataUltimos30Dias->has($dia) ? $dataUltimos30Dias[$dia]->count() : 0;
        }
        return [
            //
            Stat::make('Empreendimentos', count(Empreendimento::all()))
            ->description('Adições recentes')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart($contratosPorDia)
            ->color('success'),
        ];
    }
}
