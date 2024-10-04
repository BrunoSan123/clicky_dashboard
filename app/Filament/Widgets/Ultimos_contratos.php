<?php

namespace App\Filament\Widgets;

use App\Models\Contrato;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Ultimos_contratos extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Contrato::query()->latest()->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('numero_do_contrato')->label('Número do contrato')->searchable(),
                Tables\Columns\TextColumn::make('nome_do_contratante')->label('Nome do contratante')->searchable(),
                Tables\Columns\TextColumn::make('data_de_inicio')->label('Data de inicio')->searchable(),
                Tables\Columns\TextColumn::make('data_de_termino')->label('Data de termino')->searchable(),
                Tables\Columns\IconColumn::make('status')
                ->label('Status')
                ->boolean() // Define que a coluna é do tipo booleano
                ->trueIcon('heroicon-o-check-circle')  // Ícone de check para verdadeiro
                ->falseIcon('heroicon-o-x-circle')     // Ícone de X para falso
                ->colors([
                    'success' => 'success',  // Cor verde para verdadeiro
                    'danger' => 'danger',    // Cor vermelha para falso
                ]),
                Tables\Columns\TextColumn::make('valor_do_contrato')->label('Valor de contrato'),
                Tables\Columns\TextColumn::make('data_de_emissão')->label('Data de emissão')->dateTime(),
                Tables\Columns\TextColumn::make('empreendimento.nome_do_empreendimento')->label('Nome do empreendimento')->searchable(),
            ]);
    }
}
