<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpreendimentoResource\Pages;
use App\Filament\Resources\EmpreendimentoResource\RelationManagers;
use App\Models\Empreendimento;
use App\Models\Empresa;
use App\Models\Contrato;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Modal\Actions\ButtonAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Support\RawJs;


class EmpreendimentoResource extends Resource
{
    protected static ?string $model = Empreendimento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nome_do_empreendimento')->label('Nome do empreendimento'),
                Forms\Components\TextInput::make('tipo')->label('Tipo'),
                Forms\Components\Select::make('Empresa_id')
                ->label('Selecione uma Empresa')
                ->options(Empresa::all()->pluck('nome_da_empresa', 'id'))
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Id'),
                Tables\Columns\TextColumn::make('nome_do_empreendimento')->label('Nome do Empreendimento'),
                Tables\Columns\TextColumn::make('tipo')->label('Tipo'),
                Tables\Columns\TextColumn::make('usuario.name')->label('Usuário'),
                Tables\Columns\TextColumn::make('empresa.nome_da_empresa')->label('Empresa'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Gerar Contrato')
                ->button()
                ->form([
                    Forms\Components\TextInput::make('nome_do_contratante')->label('Nome do contrato'),
                    Forms\Components\DatePicker::make('data_de_inicio')->label('Data de inicio'),
                    Forms\Components\DatePicker::make('data_de_termino')->label('Data de termino'),
                    Forms\Components\TextInput::make('valor_do_contrato')
                    ->label('Valor do contrato')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->numeric(),
                    Forms\Components\DatePicker::make('data_de_emissão')->label('Data de emissão')


                ])->action(function (array $data, Empreendimento $record): void {
                    $contrato = new Contrato();
                    $contrato->Empreendimento_id = $record->id; // Pega o ID diretamente do $record
                    $contrato->nome_do_contratante = $data['nome_do_contratante'];
                    $contrato->data_de_inicio = $data['data_de_inicio'];
                    $contrato->data_de_termino = $data['data_de_termino'];
                    $contrato->valor_do_contrato = $data['valor_do_contrato'];
                    $contrato->data_de_emissão = $data['data_de_emissão'];
                    $contrato->save();
                })
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
            'index' => Pages\ListEmpreendimentos::route('/'),
            'create' => Pages\CreateEmpreendimento::route('/create'),
            'edit' => Pages\EditEmpreendimento::route('/{record}/edit'),
        ];
    }




}
