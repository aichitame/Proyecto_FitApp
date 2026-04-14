<?php

namespace App\Filament\Admin\Resources\Users;

use App\Filament\Admin\Resources\Users\Pages\CreateUser;
use App\Filament\Admin\Resources\Users\Pages\EditUser;
use App\Filament\Admin\Resources\Users\Pages\ListUsers;
use App\Filament\Admin\Resources\Users\Schemas\UserForm;
use App\Filament\Admin\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

public static function form(Schema $schema): Schema
{
    return $schema
    ->components([
        \Filament\Forms\Components\TextInput::make('name')
        ->required()
        ->label('Nombre'),

        \Filament\Forms\Components\TextInput::make('email')
        ->email()
        ->required()
        ->label('Correo electrónico'),

        \Filament\Forms\Components\Select::make('role')
        ->options([
            'admin' => 'Administrador',
            'client' => 'Cliente',
        ])
        ->required()
        ->default('client')
        ->label('Rol'),

        \Filament\Forms\Components\TextInput::make('password')
        ->password()
        ->dehydrated(fn ($state) => filled ($state))
        ->required(fn (string $context): bool => $context === 'create')
        ->label('Contraseña')
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
        -> columns([
            TextColumn::make('name')
            ->label('Nombre')
            ->searchable()
            ->sortable(),

            TextColumn::make('email')
            ->label('Correo electrónico')
            ->searchable(),

            TextColumn::make('role')
            ->label('Rol')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'admin' => 'danger',
                'client' => 'success',
                default => 'gray',
            })
            ->sortable(),

            TextColumn::make('created_at')
            ->label('Fecha de registro')
            ->dateTime()
            ->sortable(),
        ])
        ->filters([
            SelectFilter::make('role')
            ->label('Filtrar por rol')
            ->options([
                'admin' => 'Administrador',
                'client' => 'Cliente',
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
