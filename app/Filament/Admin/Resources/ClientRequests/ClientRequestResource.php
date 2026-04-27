<?php

namespace App\Filament\Admin\Resources\ClientRequests;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\ClientRequests\Pages\EditClientRequest;
use App\Filament\Admin\Resources\ClientRequests\Pages\ListClientRequests;
use App\Filament\Admin\Resources\ClientRequests\Schemas\ClientRequestForm;
use App\Models\ClientRequest;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ClientRequestResource extends Resource
{
    protected static ?string $model = ClientRequest::class;

    protected static ?string $navigationLabel = 'Solicitudes';
    protected static ?string $modelLabel = 'solicitud';
    protected static ?string $pluralModelLabel = 'solicitudes';

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
                TextColumn::make('id')
                    ->label('Solicitud')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.email')
                    ->label('Correo electrónico')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'in_review' => 'info',
                        'completed' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendiente',
                        'in_review' => 'En revisión',
                        'completed' => 'Completada',
                        'rejected' => 'Rechazada',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('goal')
                    ->label('Objetivo')
                    ->wrap()
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Fecha solicitud')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('status_changed_at')
                    ->label('Último cambio de estado')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'pending' => 'Pendiente',
                        'in_review' => 'En revisión',
                        'completed' => 'Completada',
                        'rejected' => 'Rechazada',
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Revisar'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClientRequests::route('/'),
            'edit' => EditClientRequest::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('user')
            ->orderByRaw("
                CASE status
                    WHEN 'pending' THEN 1
                    WHEN 'in_review' THEN 2
                    WHEN 'completed' THEN 3
                    WHEN 'rejected' THEN 4
                    ELSE 5
                END
            ")
            ->orderByDesc('created_at');
    }
}