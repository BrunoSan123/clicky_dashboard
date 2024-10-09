<?php

namespace App\Filament\Resources\ClienteResource\RelationManagers;

use App\Models\Empreendimento;
use App\Models\Unidade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratosRelationManager extends RelationManager
{
    protected static string $relationship = 'contratos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_do_contrato')
                    ->label('Número')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('Unidade_id')
                    ->label('Unidade')
                    ->options(Unidade::all()->pluck('nome_da_unidade','id'))
                    ->required(),
                Forms\Components\Select::make('Empreendimento_id')
                    ->label('Empreendimento')
                    ->options(Empreendimento::all()->pluck('nome_do_empreendimento','id'))
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(['pago'=>'Pago','pagamento pendente'=>'Pagamento pendente','em preocessamento'=>'Em processamento'])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('numero_do_contrato')
            ->columns([
                Tables\Columns\TextColumn::make('numero_do_contrato')->label('Numero do contrato'),
                Tables\Columns\TextColumn::make('unidade.nome_da_unidade')->label('Unidade'),
                Tables\Columns\TextColumn::make('empreendimento.nome_do_empreendimento')->label('Empreendimento'),
                Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'sem pendencias',        // Verde para 'sem pendencias'
                    'danger' => 'pagamento pendente',     // Vermelho para 'pagamento pendente'
                    'warning' => 'processando pagamento', // Amarelo para 'processando pagamento'
                ])
                ->formatStateUsing(fn ($state) => match ($state) {
                    'sem pendencias' => 'Sem Pendências',
                    'pagamento pendente' => 'Pagamento Pendente',
                    'processando pagamento' => 'Processando Pagamento',
                    default => 'Indefinido',
                }),

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
