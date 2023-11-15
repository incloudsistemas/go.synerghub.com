<?php

namespace App\Filament\Resources\Configs;

use App\Enums\Synerg\LegalNatureRole;
use App\Filament\Resources\Configs\LegalNatureResource\Pages;
use App\Filament\Resources\Configs\LegalNatureResource\RelationManagers;
use App\Models\Configs\LegalNature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Support;
use Illuminate\Database\Eloquent\Model;

class LegalNatureResource extends Resource
{
    protected static ?string $model = LegalNature::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Natureza Jurídica';

    protected static ?string $pluralModelLabel = 'Naturezas Jurídicas';

    protected static ?string $navigationGroup = 'Configurações';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label(__('Cód.'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->label(__('Nome'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('role')
                    ->label(__('Categoria'))
                    ->options(LegalNatureRole::asSelectArray())
                    ->required()
                    ->in(LegalNatureRole::getValues())
                    ->native(false)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label(__('Cód.'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Nome'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('display_role')
                    ->label(__('Categoria'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Cadastro'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Últ. atualização'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort(column: 'created_at', direction: 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make()
                            ->before(function (Model $record) {
                                $record->slug = null;
                            }),
                    ])
                        ->dropdown(false),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->label(__('Ações'))
                    ->icon('heroicon-m-chevron-down')
                    ->size(Support\Enums\ActionSize::ExtraSmall)
                    ->color('gray')
                    ->button()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('code')
                    ->label(__('Cód.')),
                Infolists\Components\TextEntry::make('name')
                    ->label(__('Nome')),
                Infolists\Components\TextEntry::make('display_role')
                    ->label(__('Categoria')),
                Infolists\Components\Grid::make(['default' => 3])
                    ->schema([
                        Infolists\Components\TextEntry::make('created_at')
                            ->label(__('Cadastro'))
                            ->dateTime('d/m/Y H:i'),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->label(__('Últ. atualização'))
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ])
            ->columns(3);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLegalNatures::route('/'),
        ];
    }
}
