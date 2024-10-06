<?php

namespace App\Filament\Clusters\Empreendimentos;

use App\Filament\Clusters\Empreendimentos;
use App\Filament\Clusters\Empreendimentos\EmpreendimentoResource\Pages;
use App\Filament\Widgets\Contratos_Status;
use App\Models\Cliente;
use App\Models\Empreendimento;
use App\Models\Empresa;
use App\Models\Contrato;
use App\Models\Unidade;
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
use Filament\Forms\Components\Repeater;


class EmpreendimentoResource extends Resource
{
    protected static ?string $model = Empreendimento::class;

    protected static ?string $navigationIcon = 'bi-lightning-charge';
    protected static ?string $cluster = Empreendimentos::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nome_do_empreendimento')->label('Nome do empreendimento'),
                Forms\Components\TextInput::make('tipo')->label('Tipo'),
                Forms\Components\TextInput::make('público')->label('Público'),
                Forms\Components\FileUpload::make('imagem')->avatar()->directory('storage'),
                Forms\Components\Select::make('Empresa_id')
                ->label('Selecione uma Empresa')
                ->options(Empresa::all()->pluck('nome_da_empresa', 'id'))
                ->required(),
                Forms\Components\Select::make('Usuario_id')
                ->label('Selecione o usuário')
                ->options(Cliente::all()->pluck('nome','id'))
                ->required()
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('imagem')->label('Imagem'),
                Tables\Columns\TextColumn::make('nome_do_empreendimento')->label('Nome')->searchable(),
                Tables\Columns\TextColumn::make('público')->label('Público'),
                Tables\Columns\IconColumn::make('status')
                ->label('Status')
                ->boolean() // Define que a coluna é do tipo booleano
                ->trueIcon('heroicon-o-check-circle')  // Ícone de check para verdadeiro
                ->falseIcon('heroicon-o-x-circle')     // Ícone de X para falso
                ->colors([
                    'success' => 'success',  // Cor verde para verdadeiro
                    'danger' => 'danger',    // Cor vermelha para falso
                ]),
                Tables\Columns\TextColumn::make('empresa.nome_da_empresa')->label('Empresa'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('verUnidades')
                ->label('Und Disponíveis')
                ->modalHeading('Unidades Cadastradas')
                ->form([
                    Forms\Components\Repeater::make('unidades_repeater')
                    ->label('Unidades')
                    ->schema(function ($record) {
                        $unidades = $record->unidades; // Obtém as unidades associadas ao empreendimento

                        $schemas = [];

                        foreach ($unidades as $unidade) {
                            $schemas[] = Forms\Components\Card::make() // Cria um card para cada unidade
                                ->schema([
                                    Forms\Components\TextInput::make("unidade_{$unidade->id}_nome")
                                        ->label('Nome da Unidade')
                                        ->default($unidade->nome_da_unidade)
                                        ->disabled(),
                                    Forms\Components\TextInput::make("unidade_{$unidade->id}_quantidade")
                                        ->label('Quantidade')
                                        ->default($unidade->quantidade)
                                        ->disabled(),
                                    Forms\Components\TextInput::make("unidade_{$unidade->id}_cnpj")
                                        ->label('CNPJ')
                                        ->default($unidade->cnpj)
                                        ->disabled(),
                                    Forms\Components\TextInput::make("unidade_{$unidade->id}_regiao")
                                        ->label('Região')
                                        ->default($unidade->região)
                                        ->disabled(),
                                ]);
                        }

                        return $schemas;
                    }),
                    ]),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Gerar Contrato')
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
                }),
    
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
