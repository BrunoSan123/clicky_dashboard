<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContratoResource\Pages;
use App\Models\Contrato;
use App\Models\Empreendimento;
use App\Models\Unidade;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Currencies\BRL;
use Leandrocfe\FilamentPtbrFormFields\Money;
use Rmsramos\Activitylog\Actions\ActivityLogTimelineTableAction;

class ContratoResource extends Resource
{
    protected static ?string $model = Contrato::class;

    protected static ?string $navigationIcon = 'tni-contract-o';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nome_do_contratante')->label('Nome do contratante')->required(),
                Forms\Components\DatePicker::make('data_de_inicio')->label('Data de inicio')->required(),
                Forms\Components\DatePicker::make('data_de_termino')->label('Data de termino')->required(),
                Forms\Components\Select::make('Unidade_id')
                ->label('Selecione uma Unidade')
                ->options(function ($get) {
                    $empreendimentoId = $get('Empreendimento_id'); // Obtém o ID do empreendimento selecionado
                    if ($empreendimentoId) {
                        // Retorna as unidades do empreendimento selecionado
                        return Unidade::where('empreendimento_id', $empreendimentoId)
                            ->pluck('nome_da_unidade', 'id');
                    }
                    return []; // Se não houver empreendimento selecionado, retorna vazio
                }),
                Money::make('valor_do_contrato')
                ->label('Valor do contrato')
                ->currency(BRL::class)
                ->prefix('R$'),
                Money::make('valor_da_parcela')
                ->label('Valor da parcela')
                ->currency(BRL::class)
                ->prefix('R$'),
                Forms\Components\Select::make('Empreendimento_id')
                ->label('Selecione um Empreendimento')
                ->options(Empreendimento::all()->pluck('nome_do_empreendimento', 'id'))
                ->required()
                ->reactive()
                ->afterStateUpdated(function(Set $set, $state){
                    if($state){
                        $empreendimento = Empreendimento::find($state);
                        if($empreendimento){
                            $set('nome_do_contratante',$empreendimento->usuario->nome);
                        }
                    }

                })

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
                Tables\Columns\TextColumn::make('valor_do_contrato')->label('Valor de contrato')->money('BRL'),
                Tables\Columns\TextColumn::make('valor_da_parcela')->label('Valor da parcela')->money('BRL'),
                Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'assinado',        // Verde para 'sem pendencias'
                    'danger' => 'cancelado',     // Vermelho para 'pagamento pendente'
                    'warning' => 'assinatura pendente', // Amarelo para 'processando pagamento'
                ])
                ->formatStateUsing(fn ($state) => match ($state) {
                    'assinado' => 'Assinado',
                    'assinatura pendente' => 'Assinatura pendente',
                    'cancelado' => 'Cancelado',
                    default => 'Indefinido',
                }),
                Tables\Columns\TextColumn::make('data_de_emissão')->label('Data de emissão'),
                Tables\Columns\TextColumn::make('empreendimento.nome_do_empreendimento')->label('Nome do empreendimento'),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ActivityLogTimelineTableAction::make('Activities'),
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
