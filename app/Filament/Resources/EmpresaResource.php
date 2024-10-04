<?php

namespace App\Filament\Resources;

use App\Filament\Resources;
use App\Filament\Resources\EmpresaResource\Pages;
use App\Filament\Resources\EmpresaResource\RelationManagers;
use App\Models\Cliente;
use App\Models\Empresa;
use Closure;
use Filament\Facades\Filament;
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

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nome_da_empresa')->label('Nome da empresa')->required(),
                Forms\Components\TextInput::make('cnpj')->label('CNPJ')
                ->suffixAction(fn($state,Set $set)=>
                    Action::make('search-action')
                    ->icon('feathericon-search')
                    ->action(function() use($state,$set){
                        if(blank($state)){
                            Notification::make()->title('Digite o CNPJ para validar')->danger()->send();
                            return;
                         }
                         try {
                            $cnpjData=Http::get("https://api-publica.speedio.com.br/buscarcnpj?cnpj={$state}")->throw()->json();
                            if($cnpjData['error']){
                                Notification::make()->title('CNPJ invalido')->danger()->send();
                            }else{
                                Notification::make()->title('CNPJ validado')->success()->send(); 
                            }
                         } catch (\Throwable $th) {
                            Notification::make()->title('CNPJ invalido')->danger()->send();
                            return;
                         }
                    })
                )
                ->required(),
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
            )
                ->required(),
                Forms\Components\TextInput::make('endereço')->label('Endereço')->required(),
                Forms\Components\TextInput::make('bairro')->label('Bairro')->required(),
                Forms\Components\TextInput::make('uf')->label('Estado')->required(),
                Forms\Components\TextInput::make('cidade')->label('Cidade')->required(),
                Forms\Components\Select::make('Usuario_id')
                ->label('Selecione um usuário')
                ->options(Cliente::all()->pluck('nome', 'id'))
                ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nome_da_empresa')->label('Nome da empresa'),
                Tables\Columns\TextColumn::make('cnpj')->label('CNPJ'),
                Tables\Columns\TextColumn::make('cep')->label('CEP'),
                Tables\Columns\TextColumn::make('endereço')->label('Endereço'),
                Tables\Columns\TextColumn::make('cidade')->label('Cidade'),
                Tables\Columns\TextColumn::make('uf')->label('Estado'),
                Tables\Columns\TextColumn::make('usuario.nome')->label('Usuário vinculado')

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
            'index' => Pages\ListEmpresas::route('/'),
            'create' => Pages\CreateEmpresa::route('/create'),
            'edit' => Pages\EditEmpresa::route('/{record}/edit'),
        ];
    }
}
