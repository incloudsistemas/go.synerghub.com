<?php

namespace App\Filament\Resources\Workspace;

use App\Filament\Resources\Workspace\ProductResource\Pages;
use App\Filament\Resources\Workspace\ProductResource\RelationManagers;
use App\Models\Workspace\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Produto';

    protected static ?string $navigationGroup = 'Workspace';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Infos. Gerais'))
                    ->description(__('Visão geral e informações fundamentais sobre o produto.'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Nome'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('module')
                            ->label(__('Módulo'))
                            ->options([
                                1 => 'Módulo Diagnose',
                                2 => 'Módulo Strategic'
                            ])
                            ->searchable()
                            ->required()
                            ->in([1, 2])
                            ->native(false),
                        // Forms\Components\TextInput::make('abbreviation')
                        //     ->label(__('Abreviação'))
                        //     ->maxLength(30),
                        Forms\Components\Textarea::make('description')
                            ->label(__('Descrição'))
                            ->rows(4)
                            ->minLength(2)
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                            ->label(__('Avatar'))
                            ->helperText(__('Tipos de arquivo permitidos: .png, .jpg, .jpeg, .gif. // Máx. 500x500px // 5 mb.'))
                            ->collection('avatar')
                            ->image()
                            // ->responsiveImages()
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file, callable $get): string =>
                                (string) str('-' . md5(uniqid()) . '-' . time() . '.' . $file->extension())
                                    ->prepend(Str::slug($get('name'))),
                            )
                            ->imageResizeMode('contain')
                            ->imageResizeTargetWidth('500')
                            ->imageResizeTargetHeight('500')
                            ->imageResizeUpscale(false)
                            ->maxSize(5120),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar')
                    ->label('')
                    ->collection('avatar')
                    ->conversion('thumb')
                    ->size(45)
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Nome'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('module')
                    ->label(__('Módulo'))
                    ->formatStateUsing(
                        fn (string $state): string =>
                        match ($state) {
                            '1'     => 'Módulo Diagnose',
                            '2'     => 'Módulo Strategic',
                            default => null
                        }
                    )
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
                        Tables\Actions\EditAction::make(),
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
                Infolists\Components\TextEntry::make('name')
                    ->label(__('Nome')),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
