<?php

namespace App\Filament\Admin\Resources\Plans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            //1. Muestra el nombre del Admin (coach)
                TextColumn::make('admin.name')
                    ->label('Coach')
                    ->searchable()
                    ->sortable(),

                    //2. Muestra el nombre del cliente y el número de solicitud
                TextColumn::make('clientRequest.user.name')
                    ->label('Customer')
                    ->description(fn ($record) => "Request #" . $record->client_request_id)
                    ->searchable()
                    ->sortable(),

                    //3. El título del plan
                TextColumn::make('title')
                    ->label('Plan Title')
                    ->searchable(),

                TextColumn::make('clientRequest.status')
                    ->label('Request Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                    'pending' => 'gray',
                    'processing' => 'warning',
                    'completed' => 'success',
                    default => 'gray',
                })
                ->sortable(),

                //Fechas: ocultas por defecto
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created Date')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
