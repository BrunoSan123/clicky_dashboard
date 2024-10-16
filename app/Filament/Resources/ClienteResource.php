<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Empreendimentos;
use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers\ContratosRelationManager;
use App\Filament\Resources\ClienteResource\RelationManagers\EndereçosRelationManager;
use App\Filament\Resources\ClienteResource\RelationManagers\PagamentosRelationManager;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Cliente;
use App\Models\Empreendimento;
use App\Models\Endereco;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Button;
use Filament\Pages\Actions\Modal\Actions\ButtonAction;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'fluentui-people-add-16-o';




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                ->schema([
                    // Primeiro Card - Campos da tabela `users`
                    Card::make()
                        ->schema([
                            Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nome')
                                    ->label('Nome')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->required(),
                            ])->columnSpan(1),
    
                            Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('sobrenome')
                                    ->label('Sobrenome')
                                    ->required(),
                                Forms\Components\TextInput::make('senha')
                                    ->label('Senha')
                                    ->password()
                                    ->required(),
                                Forms\Components\TextInput::make('cpf')
                                    ->label('CPF'),
                                Forms\Components\TextInput::make('cnpj')
                                    ->label('CNPJ')->suffixAction(fn($state,Set $set)=>
                                    Action::make('search-action')
                                    ->icon('feathericon-search')
                                    ->action(function() use($state,$set){
                                        if(blank($state)){
                                            Notification::make()->title('Digite o CNPJ para validar')->danger()->send();
                                            return;
                                         }
                                         try {
                                            $cnpjData=Http::get("https://api-publica.speedio.com.br/buscarcnpj?cnpj={$state}")->throw()->json();
                                            if(isset($cnpjData['error'])){
                                                Notification::make()->title('CNPJ invalido')->danger()->send();
                                            }else{
                                                //dd($cnpjData['STATUS']!='ATIVA');
                                                if($cnpjData['STATUS']!='ATIVA'){
                                                    Notification::make()->title('Ação não permitida. O status precisa ser ativo.')->danger()->send();
                                                    $set('apiStatus','inativa');
                                                    return; // Evita que o formulário seja enviado
                                                    
                                                
                                                }else{
                                                    $set('nome',$cnpjData['NOME FANTASIA']);
                                                    Notification::make()->title('CNPJ validado')->success()->send();
                                                    
                                                }
                                                
                
                                            }
                                         } catch (\Throwable $th) {
                                            dd($th->getMessage());
                                            Notification::make()->title('Erro na requisição')->danger()->send();
                                            return;
                                         }
                                    })
                                ),
                            ])->columnSpan(1),

                            Grid::make(2)
                            ->schema([
                                
                                Forms\Components\TextInput::make('cidade')
                                ->label('Cidade')
                                ->required(),
                            Forms\Components\TextInput::make('rua')
                                ->label('Rua')
                                ->required(),
                            Forms\Components\TextInput::make('pais')
                                ->label('País')
                                ->required(),
                            ])->columnSpan(1),
                        ])->columnSpan(1),
    
                    // Repeater para múltiplos endereços

    
                    // Segundo Card - Campos apenas para visualização
                    Card::make()
                        ->schema([
                            Forms\Components\Placeholder::make('created_at')
                                ->label('Criado em')
                                ->content(fn ($record) => $record->created_at->format('d/m/Y H:i:s')),
                            Forms\Components\Placeholder::make('updated_at')
                                ->label('Atualizado em')
                                ->content(fn ($record) => $record->updated_at->format('d/m/Y H:i:s')),
                        ])->columnSpan(1)
                        ->visibleOn('edit')
                ])
                    ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nome')->label('Nome'),
                Tables\Columns\TextColumn::make('sobrenome')->label('Sobrenome'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                //Tables\Columns\TextColumn::make('cnpj')->label('CNPJ'),
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
            EndereçosRelationManager::class,
            PagamentosRelationManager::class,
            ContratosRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCliente::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }



    public static function saved($record): void
    {
        // Aqui você pode associar o id do cliente aos endereços
        foreach ($record->enderecos as $endereco) {
            $endereco->Usuario_id = $record->id; // Associa o id do cliente
            $endereco->save(); // Salva o endereço
        }
    }
}
