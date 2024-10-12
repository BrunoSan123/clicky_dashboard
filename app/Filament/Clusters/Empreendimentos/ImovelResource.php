<?php

namespace App\Filament\Clusters\Empreendimentos;

use App\Filament\Clusters\Empreendimentos;
use App\Filament\Clusters\Empreendimentos\ImovelResource\Pages;
use App\Filament\Clusters\Empreendimentos\Resources\ImovelResource\RelationManagers;
use App\Models\Imovel;
use App\Models\Unidade;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Http;

class ImovelResource extends Resource
{
    protected static ?string $model = Imovel::class;

    protected static ?string $navigationIcon = 'ionicon-business-outline';

    protected static ?string $cluster = Empreendimentos::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nome_do_imovel')->label('Nome do imovel')->required(),
                Forms\Components\TextInput::make('cep')->label('CEP')
                ->suffixAction(fn($state, Set $set)=>
                Action::make('search-action')
                ->icon('feathericon-search')
                ->action(function() use($state,$set){
                    if(blank($state)){
                       Notification::make()->title('Digite o CEP para buscar o endereço')->danger()->send();
                       return;
                    }
                    try {
                        $cepData=Http::get("https://viacep.com.br/ws/{$state}/json/")->throw()->json();
                        //dd($cepData);
                    } catch (\Throwable $th) {
                        Notification::make()->title('Erro ao buscar o endereço')->danger();
                        return;
                    }

                    $set('bairro', $cepData['bairro'] ?? null);
                    $set('endereço', $cepData['logradouro'] ?? null);
                    $set('uf', $cepData['estado'] ?? null);
                    $set('cidade', $cepData['localidade'] ?? null);
                })
            )->required(),
                Forms\Components\TextInput::make('endereço')->label('Endereço')->required(),
                Forms\Components\TextInput::make('uf')->label('Estado')->required(),
                Forms\Components\TextInput::make('cidade')->label('Cidade')->required(),
                Forms\Components\Select::make('Unidade_id')->label('Unidade')->options(Unidade::all()->pluck('nome_da_unidade','id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nome_do_imovel')->label('Número do imovel')->searchable(),
                Tables\Columns\TextColumn::make('cep')->label('CEP')->searchable(),
                Tables\Columns\TextColumn::make('endereço')->label('Endereço')->searchable(),
                Tables\Columns\TextColumn::make('uf')->label('Estado')->searchable( ),
                Tables\Columns\TextColumn::make('cidade')->label('Cidade')->searchable(),
                Tables\Columns\TextColumn::make('unidade.nome_da_unidade')->label('Unidade')->searchable(),

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
            'index' => Pages\ListImovels::route('/'),
            'create' => Pages\CreateImovel::route('/create'),
            'edit' => Pages\EditImovel::route('/{record}/edit'),
        ];
    }
}
