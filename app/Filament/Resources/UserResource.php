<?php

namespace App\Filament\Resources;

use App\Enums\ProfileInfos\MaritalStatus;
use App\Enums\ProfileInfos\EducationalLevel;
use App\Enums\ProfileInfos\Gender;
use App\Enums\UserStatus;
use App\Filament\Resources\RelationManagers\AddressesRelationManager;
use App\Filament\Resources\RelationManagers\MediaAttachsRelationManager;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\Workspace\ContactIndividual;
use App\Models\Workspace\ContactLegalEntity;
use App\Services\Permissions\RoleService;
use App\Services\UserService;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Usuário';

    protected static ?string $navigationGroup = 'Configurações';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make(__('Infos. Gerais'))
                            ->description(__('Visão geral e informações fundamentais sobre o usuário.'))
                            ->schema([
                                static::getContactFormField(),
                                static::getNameFormField(),
                                static::getEmailFormField(),
                                static::getRolesFormField(),
                                static::getPasswordFormField(),
                                static::getPasswordConfirmationFormField(),
                            ])
                            ->columns(2)
                            ->collapsible(),
                    ])
                    ->visibleOn('create')
                    ->columnSpanFull(),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make(__('Infos. Gerais'))
                            ->description(__('Visão geral e informações fundamentais sobre o usuário.'))
                            ->schema([
                                static::getContactFormField(),
                                static::getNameFormField(),
                                static::getEmailFormField(),
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
                        Forms\Components\Section::make(__('Acesso ao Sistema'))
                            ->description(__('Gerencie o nível de acesso do usuário.'))
                            ->schema([
                                Forms\Components\TextInput::make('email_confirmation')
                                    ->label(__('Usuário'))
                                    ->placeholder(__('Preencha o email'))
                                    ->required()
                                    ->readOnly()
                                    ->columnSpanFull(),
                                static::getRolesFormField(),
                                static::getPasswordFormField(),
                                static::getPasswordConfirmationFormField(),
                                Forms\Components\Select::make('status')
                                    ->label(__('Status'))
                                    ->options(UserStatus::asSelectArray())
                                    ->default(1)
                                    ->required()
                                    ->in(UserStatus::getValues())
                                    ->native(false),
                            ])
                            ->columns(2)
                            ->collapsible(),
                        Forms\Components\Section::make(__('Infos. Complementares'))
                            ->description(__('Forneça informações adicionais relevantes.'))
                            ->relationship(name: 'contact')
                            ->schema([
                                Forms\Components\Group::make()
                                    ->relationship(name: 'contactable')
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
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('complement')
                                    ->label(__('Sobre'))
                                    ->rows(4)
                                    ->minLength(2)
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                                Forms\Components\Group::make()
                                    ->relationship(name: 'contactable')
                                    ->schema([
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
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->collapsible(),
                    ])
                    ->visibleOn('edit')
                    ->columnSpanFull(),
            ]);
    }

    public static function getContactFormField(): Forms\Components\Select
    {
        return Forms\Components\Select::make('contact_id')
            ->label(__('Contato'))
            ->searchable()
            ->preload()
            ->getSearchResultsUsing(
                fn (ContactService $service, string $search): array =>
                $service->getUserContactOptionsBySearch(search: $search),
            )
            ->getOptionLabelUsing(
                fn (ContactService $service, string $value): string =>
                $service->getContactOptionLabel(value: $value),
            )
            ->required()
            ->live(debounce: 1000)
            ->afterStateUpdated(
                function (
                    ContactService $service,
                    callable $set,
                    ?string $state
                ): void {
                    $infos = $service->getContactInfos(contactId: $state);
                    $set('name', $infos['name']);
                    $set('email', $infos['email']);
                    $set('email_confirmation', $infos['email']);
                }
            )
            ->when(
                auth()->user()->can('Cadastrar Contatos P. Físicas') ||
                    auth()->user()->can('Cadastrar Contatos P. Jurídicas'),
                fn (Forms\Components\Select $component): Forms\Components\Select =>
                $component->suffixAction(
                    Forms\Components\Actions\Action::make('contact')
                        ->icon('heroicon-o-plus')
                        ->form([
                            Forms\Components\Grid::make(['default' => 2])
                                ->schema([
                                    Forms\Components\Select::make('contactable_type')
                                        ->label(__('Tipo de contato'))
                                        ->options([
                                            'contact_individuals' => 'P. Física',
                                        ])
                                        // ->options(function (): array {
                                        //     if (
                                        //         auth()->user()->can('Cadastrar Contatos P. Físicas') &&
                                        //         auth()->user()->can('Cadastrar Contatos P. Jurídicas')
                                        //     ) {
                                        //         return [
                                        //             'contact_individuals'    => 'P. Física',
                                        //             'contact_legal_entities' => 'P. Jurídica',
                                        //         ];
                                        //     }

                                        //     if (auth()->user()->can('Cadastrar Contatos P. Físicas')) {
                                        //         return [
                                        //             'contact_individuals' => 'P. Física',
                                        //         ];
                                        //     }

                                        //     if (auth()->user()->can('Cadastrar Contatos P. Jurídicas')) {
                                        //         return [
                                        //             'contact_legal_entities' => 'P. Jurídica',
                                        //         ];
                                        //     }

                                        //     return [];
                                        // })
                                        ->default(
                                            fn (): string =>
                                            auth()->user()->can('Cadastrar Contatos P. Físicas')
                                                ? 'contact_individuals'
                                                : 'contact_legal_entities',
                                        )
                                        ->required()
                                        ->live()
                                        ->selectablePlaceholder(false)
                                        ->native(false)
                                        ->columnSpanFull(),
                                    Forms\Components\TextInput::make('name')
                                        ->label(__('Nome'))
                                        ->required()
                                        ->minLength(2)
                                        ->maxLength(255)
                                        ->columnSpanFull(),
                                    Forms\Components\TextInput::make('email')
                                        ->label(__('Email'))
                                        ->email()
                                        ->unique(ContactIndividual::class, 'email', ignoreRecord: true)
                                        ->required()
                                        ->maxLength(255)
                                        ->visible(
                                            fn (callable $get): bool =>
                                            $get('contactable_type') == 'contact_individuals'
                                        ),
                                    Forms\Components\TextInput::make('email')
                                        ->label(__('Email'))
                                        ->email()
                                        ->unique(ContactLegalEntity::class, 'email', ignoreRecord: true)
                                        ->required()
                                        ->maxLength(255)
                                        ->visible(
                                            fn (callable $get): bool =>
                                            $get('contactable_type') == 'contact_legal_entities'
                                        ),
                                    Forms\Components\Hidden::make('phones.0.name')
                                        ->default(null),
                                    Forms\Components\TextInput::make('phones.0.number')
                                        ->label(__('Nº do telefone'))
                                        ->mask(
                                            Support\RawJs::make(<<<'JS'
                                                $input.length === 14 ? '(99) 9999-9999' : '(99) 99999-9999'
                                            JS)
                                        )
                                        ->live(onBlur: true)
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('cpf')
                                        ->label(__('CPF'))
                                        ->mask('999.999.999-99')
                                        ->unique(ContactIndividual::class, 'cpf', ignoreRecord: true)
                                        ->maxLength(255)
                                        ->visible(
                                            fn (callable $get): bool =>
                                            $get('contactable_type') == 'contact_individuals'
                                        ),
                                    Forms\Components\TextInput::make('cnpj')
                                        ->label(__('CNPJ'))
                                        ->mask('99.999.999/9999-99')
                                        ->unique(ContactLegalEntity::class, 'cnpj', ignoreRecord: true)
                                        ->maxLength(255)
                                        ->visible(
                                            fn (callable $get): bool =>
                                            $get('contactable_type') == 'contact_legal_entities'
                                        ),
                                ])
                        ])
                        ->action(
                            function (array $data, callable $set): void {
                                if ($data['contactable_type'] === 'contact_individuals') {
                                    $contactable = ContactIndividual::create($data);
                                } elseif ($data['contactable_type'] === 'contact_legal_entities') {
                                    $contactable = ContactLegalEntity::create($data);
                                }

                                if ($contactable) {
                                    $contact = $contactable->contact()->create([
                                        'phones' => $data['phones'],
                                    ]);

                                    $set('contact_id', $contact->id);
                                    $set('name', $contactable->name);
                                    $set('email', $contactable->email);
                                    $set('email_confirmation', $contactable->email);
                                }
                            }
                        ),
                ),
            )
            ->disabled(
                fn (string $operation): bool =>
                $operation === 'edit'
            )
            ->dehydrated()
            ->columnSpanFull();
    }

    public static function getNameFormField(): Forms\Components\Hidden
    {
        return Forms\Components\Hidden::make('name')
            ->label(__('Nome'))
            ->required();
    }

    public static function getPasswordFormField(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('password')
            ->label(__('Senha'))
            ->password()
            ->helperText(
                fn (string $operation): string =>
                $operation === 'create'
                    ? __('Senha com mín. de 8 digitos.')
                    : __('Preencha apenas se desejar alterar a senha. Min. de 8 dígitos.')
            )
            ->required(
                fn (string $operation): bool =>
                $operation === 'create'
            )
            ->confirmed()
            ->minLength(8)
            ->maxLength(255);
    }

    public static function getPasswordConfirmationFormField(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('password_confirmation')
            ->label(__('Confirmar senha'))
            ->password()
            ->required(
                fn (string $operation): bool =>
                $operation === 'create'
            )
            ->maxLength(255)
            ->dehydrated(false);
    }

    public static function getRolesFormField(): Forms\Components\Select
    {
        return Forms\Components\Select::make('roles')
            ->label(__('Nível de acesso'))
            ->relationship(
                name: 'roles',
                titleAttribute: 'name',
                modifyQueryUsing: fn (RoleService $service, Builder $query): Builder =>
                $service->getRolesbyAuthUserRoles(query: $query)
            )
            // ->multiple()
            ->searchable()
            ->preload()
            ->required()
            // ->native(false)
            ->columnSpanFull();
    }

    public static function getEmailFormField(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('email')
            ->label(__('Email'))
            ->email()
            ->required()
            ->unique(ignoreRecord: true)
            ->confirmed()
            ->maxLength(255)
            ->live(onBlur: true)
            ->afterStateUpdated(
                fn (callable $set, ?string $state): ?string =>
                $set('email_confirmation', $state)
            )
            ->columnSpanFull();
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
                Tables\Columns\TextColumn::make('roles.name')
                    ->label(__('Nível de acesso'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact.contactable.cpf')
                    ->label(__('CPF'))
                    ->searchable(
                        query: fn (UserService $service, Builder $query, string $search): Builder =>
                        $service->tableSearchByCpf(query: $query, search: $search)
                    )
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('contact.display_main_phone')
                    ->label(__('Telefone'))
                    ->searchable(
                        query: fn (UserService $service, Builder $query, string $search): Builder =>
                        $service->tableSearchByPhone(query: $query, search: $search)
                    )
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('display_status')
                    ->label(__('Status'))
                    // ->formatStateUsing(fn (int $state): string => UserStatus::getDescription($state))
                    ->badge()
                    ->color(
                        fn (string $state): string =>
                        UserStatus::getColorByDescription(statusDesc: $state)
                    )
                    ->searchable(
                        query: fn (UserService $service, Builder $query, string $search): Builder =>
                        $service->tableSearchByStatus(query: $query, search: $search)
                    )
                    ->sortable(
                        query: fn (UserService $service, Builder $query, string $direction): Builder =>
                        $service->tableSortByStatus(query: $query, direction: $direction)
                    ),
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
                Tables\Filters\SelectFilter::make('roles')
                    ->label(__('Níveis de acessos'))
                    ->relationship(
                        name: 'roles',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (RoleService $service, Builder $query): Builder =>
                        $service->getRolesbyAuthUserRoles(query: $query)
                    )
                    ->multiple()
                    ->preload(),
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('Status'))
                    ->multiple()
                    ->options(UserStatus::asSelectArray()),
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
                Infolists\Components\TextEntry::make('roles.name')
                    ->label(__('Nível de acesso')),
                Infolists\Components\TextEntry::make('email'),
                Infolists\Components\TextEntry::make('contact.display_main_phone')
                    ->label(__('Telefone'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.contactable.cpf')
                    ->label(__('CPF'))
                    ->visible(
                        fn (string|array $state): bool =>
                        !is_array($state) && !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.contactable.rg')
                    ->label(__('RG'))
                    ->visible(
                        fn (string|array $state): bool =>
                        !is_array($state) && !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.contactable.display_gender')
                    ->label(__('Sexo'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.contactable.display_birth_date')
                    ->label(__('Dt. nascimento'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.contactable.display_marital_status')
                    ->label(__('Estado civil'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.contactable.display_educational_level')
                    ->label(__('Escolaridade'))
                    ->visible(
                        fn (?string $state): bool =>
                        !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.contactable.nationality')
                    ->label(__('Nacionalidade'))
                    ->visible(
                        fn (string|array $state): bool =>
                        !is_array($state) && !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.contactable.citizenship')
                    ->label(__('Naturalidade'))
                    ->visible(
                        fn (string|array $state): bool =>
                        !is_array($state) && !empty($state),
                    ),
                Infolists\Components\TextEntry::make('contact.complement')
                    ->label(__('Sobre'))
                    ->visible(
                        fn (string|array $state): bool =>
                        !is_array($state) && !empty($state),
                    )
                    ->columnSpanFull(),
                Infolists\Components\Grid::make(['default' => 3])
                    ->schema([
                        Infolists\Components\TextEntry::make('display_status')
                            ->label(__('Status'))
                            ->badge()
                            ->color(
                                fn (string $state): string =>
                                UserStatus::getColorByDescription(statusDesc: $state)
                            ),
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
            // MediaAttachsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        return parent::getEloquentQuery()
            ->with('contact', 'contact.contactable')
            ->has('contact')
            ->byAuthUserRoles($user);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }
}
