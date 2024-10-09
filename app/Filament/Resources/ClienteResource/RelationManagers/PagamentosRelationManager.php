<?php

namespace App\Filament\Resources\ClienteResource\RelationManagers;

use App\Models\Contrato;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PagamentosRelationManager extends RelationManager
{
    protected static string $relationship = 'pagamentos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('valor')
                    ->label('Fatura')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('pago')
                    ->label('Status')
                    ->options([1=>'Pago',0=>'Não pago'])
                    ->required(),
                Forms\Components\Select::make('Contrato_id')
                    ->label('Contratos')
                    ->options(Contrato::all()->pluck('numero_do_contrato', 'id'))
                    ->required(),
                Forms\Components\DatePicker::make('data_de_vencimento')
                    ->label('Data de vencimento')
                    ->required()
            ]);
            
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('valor')
            ->columns([
                Tables\Columns\TextColumn::make('valor')->label('Fatura'),
                Tables\Columns\TextColumn::make('data_de_vencimento')->label('Data de vencimentos'),
                Tables\Columns\TextColumn::make('contratos.empreendimento.nome_do_empreendimento')->label('Empreendimento'),
                Tables\Columns\IconColumn::make('pago')->label('Status')            
                ->boolean() // Define que a coluna é do tipo booleano
                ->trueIcon('heroicon-o-check-circle')  // Ícone de check para verdadeiro
                ->falseIcon('heroicon-o-x-circle')     // Ícone de X para falso
                ->colors([
                    'success' => 'success',  // Cor verde para verdadeiro
                    'danger' => 'danger',    // Cor vermelha para falso
                ]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
