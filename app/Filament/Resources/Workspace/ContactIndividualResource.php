<?php

namespace App\Filament\Resources\Workspace;

use App\Enums\ProfileInfos\EducationalLevel;
use App\Enums\ProfileInfos\Gender;
use App\Enums\ProfileInfos\MaritalStatus;
use App\Filament\Resources\Workspace\ContactIndividualResource\Pages;
use App\Filament\Resources\Workspace\ContactIndividualResource\RelationManagers;
use App\Models\Workspace\ContactIndividual;
use App\Services\Workspace\ContactService;
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


class ContactIndividualResource extends Resource
{
    protected static ?string $model = ContactIndividual::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Contato P. Física';

    protected static ?string $navigationGroup = 'Workspace';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Infos. Gerais'))
                    ->description(__('Visão geral e informações fundamentais sobre o usuário.'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Nome'))
                            ->required()
                            ->minLength(2)
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Group::make()
                            ->relationship(name: 'contact')
                            ->schema([
                                Forms\Components\Repeater::make('additional_emails')
                                    ->label(__('Emails adicionais'))
                                    ->schema([
                                        Forms\Components\TextInput::make('email')
                                            ->label(__('Email'))
                                            // ->required()
                                            ->live(onBlur: true)
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('name')
                                            ->label(__('Tipo de email'))
                                            ->helperText(__('Nome identificador. Ex: Pessoal, Trabalho...'))
                                            ->minLength(2)
                                            ->maxLength(255)
                                            ->datalist([
                                                'Pessoal',
                                                'Trabalho',
                                                'Outros'
                                            ])
                                            ->autocomplete(false),
                                    ])
                                    ->itemLabel(
                                        fn (array $state): ?string =>
                                        $state['email'] ?? null
                                    )
                                    ->addActionLabel(__('Adicionar email'))
                                    ->defaultItems(0)
                                    ->reorderableWithButtons()
                                    ->collapsible()
                                    ->collapseAllAction(
                                        fn (Forms\Components\Actions\Action $action) =>
                                        $action->label(__('Minimizar todos'))
                                    )
                                    ->deleteAction(
                                        fn (Forms\Components\Actions\Action $action) =>
                                        $action->requiresConfirmation()
                                    )
                                    ->columnSpanFull()
                                    ->columns(2),
                                Forms\Components\Repeater::make('phones')
                                    ->label(__('Telefone(s) de contato'))
                                    ->schema([
                                        Forms\Components\TextInput::make('number')
                                            ->label(__('Nº do telefone'))
                                            ->mask(
                                                Support\RawJs::make(<<<'JS'
                                                    $input.length === 14 ? '(99) 9999-9999' : '(99) 99999-9999'
                                                JS)
                                            )
                                            ->live(onBlur: true)
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('name')
                                            ->label(__('Tipo de contato'))
                                            ->helperText(__('Nome identificador. Ex: Celular, Whatsapp, Casa, Trabalho...'))
                                            ->minLength(2)
                                            ->maxLength(255)
                                            ->datalist([
                                                'Celular',
                                                'Whatsapp',
                                                'Casa',
                                                'Trabalho',
                                                'Outros'
                                            ])
                                            ->autocomplete(false),
                                    ])
                                    ->itemLabel(
                                        fn (array $state): ?string =>
                                        $state['number'] ?? null
                                    )
                                    ->addActionLabel(__('Adicionar telefone'))
                                    ->reorderableWithButtons()
                                    ->collapsible()
                                    ->collapseAllAction(
                                        fn (Forms\Components\Actions\Action $action) =>
                                        $action->label(__('Minimizar todos'))
                                    )
                                    ->deleteAction(
                                        fn (Forms\Components\Actions\Action $action) =>
                                        $action->requiresConfirmation()
                                    )
                                    ->columnSpanFull()
                                    ->columns(2),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),
                Forms\Components\Section::make(__('Infos. Complementares'))
                    ->description(__('Forneça informações adicionais relevantes.'))
                    ->schema([
                        Forms\Components\TextInput::make('cpf')
                            ->label(__('CPF'))
                            ->mask('999.999.999-99')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('rg')
                            ->label(__('RG'))
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->label(__('Sexo'))
                            ->options(Gender::asSelectArray())
                            ->in(Gender::getValues())
                            ->native(false),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label(__('Dt. nascimento'))
                            ->format('d/m/Y')
                            ->maxDate(now()),
                        Forms\Components\Select::make('marital_status')
                            ->label(__('Estado civil'))
                            ->options(MaritalStatus::asSelectArray())
                            ->searchable()
                            ->in(MaritalStatus::getValues())
                            ->native(false),
                        Forms\Components\Select::make('educational_level')
                            ->label(__('Escolaridade'))
                            ->options(EducationalLevel::asSelectArray())
                            ->searchable()
                            ->in(EducationalLevel::getValues())
                            ->native(false),
                        Forms\Components\TextInput::make('nationality')
                            ->label(__('Nacionalidade'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('citizenship')
                            ->label(__('Naturalidade'))
                            ->maxLength(255),
                        Forms\Components\Group::make()
                            ->relationship(name: 'contact')
                            ->schema([
                                Forms\Components\Textarea::make('complement')
                                    ->label(__('Sobre'))
                                    ->rows(4)
                                    ->minLength(2)
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ])
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
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->label(__('CPF'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('contact.display_main_phone')
                    ->label(__('Telefone'))
                    ->searchable(
                        query: fn (ContactService $service, Builder $query, string $search): Builder =>
                        $service->tableSearchByPhone(query: $query, search: $search)
                    )
                    ->toggleable(isToggledHiddenByDefault: false),
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
                Infolists\Components\TextEntry::make('email'),
                Infolists\Components\TextEntry::make('contact.display_main_phone')
                    ->label(__('Telefone'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('cpf')
                    ->label(__('CPF'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('rg')
                    ->label(__('RG'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('display_gender')
                    ->label(__('Sexo'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('display_birth_date')
                    ->label(__('Dt. nascimento'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('display_marital_status')
                    ->label(__('Estado civil'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('display_educational_level')
                    ->label(__('Escolaridade'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('nationality')
                    ->label(__('Nacionalidade'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('citizenship')
                    ->label(__('Naturalidade'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.complement')
                    ->label(__('Sobre'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    )
                    ->columnSpanFull(),
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
            'index'  => Pages\ListContactIndividuals::route('/'),
            'create' => Pages\CreateContactIndividual::route('/create'),
            'edit'   => Pages\EditContactIndividual::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('contact')
            ->whereHas('contact');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'cpf'];
    }
}
