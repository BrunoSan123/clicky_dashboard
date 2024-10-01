<?php

namespace App\Filament\Clusters\Empreendimentos;

use App\Filament\Clusters\Empreendimentos;
use App\Filament\Clusters\Empreendimentos\ContratoResource\Pages;
use App\Models\Contrato;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratoResource extends Resource
{
    protected static ?string $model = Contrato::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $cluster = Empreendimentos::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('numero_do_contrato')->label('Número do contrato'),
                Tables\Columns\TextColumn::make('nome_do_contratante')->label('Nome do contratante'),
                Tables\Columns\TextColumn::make('data_de_inicio')->label('Data de inicio'),
                Tables\Columns\TextColumn::make('data_de_termino')->label('Data de termino'),
                Tables\Columns\TextColumn::make('valor_do_contrato')->label('Valor de contrato'),
                Tables\Columns\TextColumn::make('data_de_emissão')->label('Data de emissão'),
                Tables\Columns\TextColumn::make('empreendimento.nome_do_empreendimento')->label('Nome do empreendimento'),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContratos::route('/'),
            'create' => Pages\CreateContrato::route('/create'),
            'edit' => Pages\EditContrato::route('/{record}/edit'),
        ];
    }
}
