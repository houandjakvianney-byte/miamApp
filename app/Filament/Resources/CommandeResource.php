<?php

namespace App\Filament\Resources;

use App\Enums\StatutCommande;
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

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Commandes';

    protected static ?string $modelLabel = 'commande';

    protected static ?int $navigationSort = 3;

    // Pas de création manuelle : les commandes naissent côté client uniquement.
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('statut')
                ->options(collect(StatutCommande::cases())->mapWithKeys(
                    fn (StatutCommande $s) => [$s->value => $s->label()]
                ))
                ->required(),

            Forms\Components\TextInput::make('adresse_livraison')
                ->label('Adresse de livraison')
                ->disabled(),

            Forms\Components\TextInput::make('montant_total')
                ->label('Montant total (FCFA)')
                ->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('N°')->sortable(),
                Tables\Columns\TextColumn::make('utilisateur.nom')->label('Client')->searchable(),
                Tables\Columns\TextColumn::make('adresse_livraison')->limit(30),
                Tables\Columns\TextColumn::make('montant_total')->money('XOF', divideBy: 1),
                Tables\Columns\SelectColumn::make('statut')
                    ->options(collect(StatutCommande::cases())->mapWithKeys(
                        fn (StatutCommande $s) => [$s->value => $s->label()]
                    )),
                Tables\Columns\TextColumn::make('created_at')->label('Reçue le')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('statut')
                    ->options(collect(StatutCommande::cases())->mapWithKeys(
                        fn (StatutCommande $s) => [$s->value => $s->label()]
                    )),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommandes::route('/'),
            'edit' => Pages\EditCommande::route('/{record}/edit'),
        ];
    }
}
