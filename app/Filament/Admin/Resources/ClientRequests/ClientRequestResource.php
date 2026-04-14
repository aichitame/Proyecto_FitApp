<?php

namespace App\Filament\Admin\Resources\ClientRequests;

use App\Filament\Admin\Resources\ClientRequests\Pages\CreateClientRequest;
use App\Filament\Admin\Resources\ClientRequests\Pages\EditClientRequest;
use App\Filament\Admin\Resources\ClientRequests\Pages\ListClientRequests;
use App\Filament\Admin\Resources\ClientRequests\Schemas\ClientRequestForm;
use App\Filament\Admin\Resources\ClientRequests\Tables\ClientRequestsTable;
use App\Models\ClientRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
class ClientRequestResource extends Resource
{
    protected static ?string $model = ClientRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ClientRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('user.name')
            ->label('Cliente')
            ->searchable()
            ->sortable(),

            TextColumn::make('age')
            ->label('Edad')
            ->sortable(),

            TextColumn::make('weight')
            ->label('Peso (kg)')
            ->suffix(' kg'),

            TextColumn::make('goal')
            ->label('Objetivo')
            ->badge()
            ->color('info'),

            TextColumn::make('created_at')
            ->label('Fecha solicitud')
            ->dateTime('d/m/Y H:i')
            ->sortable(),
        ])

        ->filters([
            SelectFilter::make('goal')
            ->label('Objetivo')
            ->options([
                'loss' => 'Perder peso',
                'gain' => 'Ganar músculo',
                'maintain' => 'Mantenerse',
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
            'index' => ListClientRequests::route('/'),
            'create' => CreateClientRequest::route('/create'),
            'edit' => EditClientRequest::route('/{record}/edit'),
        ];
    }
}
