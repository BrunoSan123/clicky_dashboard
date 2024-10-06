<?php

namespace App\Filament\Widgets;

use App\Models\Contrato;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class Contratos_chart extends ChartWidget
{
    protected static ?string $heading = 'Novos Contratos';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data=Trend::model(Contrato::class)->between(
            start: now()->subYear(),
            end: now(),
        )
        ->perMonth()
        ->count();
        return [
            //
            'datasets' => [
                [
                    'label' => 'Novos Contratos',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
