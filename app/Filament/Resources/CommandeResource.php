<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandeResource\Pages;
use App\Models\Commande;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CommandeResource extends Resource
{
    protected static ?string $model = Commande::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $label = 'Commandes';
    protected static ?string $pluralLabel = 'Commandes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('utilisateur_id')
                    ->label('Utilisateur')
                    ->relationship('utilisateur', 'nom')
                    ->required(),
                Forms\Components\Select::make('statut')
                    ->label('Statut')
                    ->options([
                        'en_attente' => 'En attente',
                        'en_preparation' => 'En préparation',
                        'en_livraison' => 'En livraison',
                        'livree' => 'Livrée',
                        'annulee' => 'Annulée',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('montant_total')
                    ->label('Montant total')
                    ->numeric()
                    ->disabled(),
                Forms\Components\Textarea::make('adresse_livraison')
                    ->label('Adresse de livraison'),
                Forms\Components\Textarea::make('notes')
                    ->label('Notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('utilisateur.nom')
                    ->label('Client')
                    ->searchable(),
                Tables\Columns\TextColumn::make('statut')
                    ->label('Statut')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'en_attente' => 'warning',
                        'en_preparation' => 'info',
                        'en_livraison' => 'primary',
                        'livree' => 'success',
                        'annulee' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('montant_total')
                    ->label('Montant')
                    ->money('eur'),
                Tables\Columns\TextColumn::make('date_commande')
                    ->label('Date')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('statut')
                    ->options([
                        'en_attente' => 'En attente',
                        'en_preparation' => 'En préparation',
                        'en_livraison' => 'En livraison',
                        'livree' => 'Livrée',
                        'annulee' => 'Annulée',
                    ]),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommandes::route('/'),
            'edit' => Pages\EditCommande::route('/{record}/edit'),
        ];
    }
}
