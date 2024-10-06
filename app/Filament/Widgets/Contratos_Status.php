<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContratoResource\Pages\ListContratos;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Empreendimento;
use App\Models\Pagamento;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Widgets\Concerns\InteractsWithPageTable;

class Contratos_Status extends BaseWidget
{
    protected function getStats(): array
    {
        $ContratoUltimos30Dias = Contrato::where('created_at', '>=', Carbon::now()->subDays(30))
        ->orderBy('created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d'); // Agrupando por dia
        });

        $clientes=Cliente::where('created_at', '>=', Carbon::now()->subDays(30))
        ->orderBy('created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d'); // Agrupando por dia
        });;

        // Criando um array para contar contratos por dia
        $contratosPorDia = [];
        for ($i = 1; $i <= 30; $i++) {
            $dia = Carbon::now()->subDays(30 - $i)->format('d');
            $contratosPorDia[] = $ContratoUltimos30Dias->has($dia) ? $ContratoUltimos30Dias[$dia]->count() : 0;
        }

        $clientePorDia = [];
        for ($i = 1; $i <= 30; $i++) {
            $dia = Carbon::now()->subDays(30 - $i)->format('d');
            $clientePorDia[] = $clientes->has($dia) ? $clientes[$dia]->count() : 0;
        }
        $valoresDeContratos=0;
        foreach(Contrato::all() as $contrato)
        {
            $valoresDeContratos.=$contrato->valor_do_contrato;
        }
        if($valoresDeContratos>1000){
            $valoresDeContratos.='mil';
        }elseif($valoresDeContratos>2000000){
            $valoresDeContratos.='milhões';
        }
        return [
            //
            Stat::make('Receitas', 'R$ '.$valoresDeContratos)
            ->description('Adições recentes')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart($contratosPorDia)
            ->color('success'),

            Stat::make('Novos clientes', (count($clientes)>1000)?count($clientes).'mil':count($clientes))
            ->description('Adições recentes')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart($clientePorDia)
            ->color('success'),

            Stat::make('Novos Pagamentos', (count(Pagamento::all())>1000)?count(Pagamento::all()).'mil':count(Pagamento::all()))
            ->description('Adições recentes')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart($contratosPorDia)
            ->color('success'),
        ];
    }


}
