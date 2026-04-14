<?php

namespace App\Filament\Admin\Resources\ClientRequests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ClientRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Cliente')
                    ->required(),

                TextInput::make('age')
                    ->label('Edad')
                    ->required()
                    ->numeric(),

                TextInput::make('gender')
                    ->label('Sexo')
                    ->required(),

                TextInput::make('height')
                    ->label('Altura')
                    ->required()
                    ->numeric(),

                TextInput::make('weight')
                    ->label('Peso')
                    ->required()
                    ->numeric(),

                TextInput::make('goal')
                    ->label('Objetivo')
                    ->required(),

                TextInput::make('activity_level')
                    ->label('Nivel de actividad')
                    ->required(),

                TextInput::make('training_days')
                    ->label('Días de entrenamiento')
                    ->required()
                    ->numeric(),

                TextInput::make('food_preference')
                    ->label('Preferencia alimentaria')
                    ->required(),

                Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),

                Select::make('status')
                ->label('Estado')
                ->options([
                    'pending' => 'Pending',
                    'in_review' => 'En revisión',
                    'completed' => 'Completed',
                    'rejected' => 'Rechazada',
                ])
                    ->default('pending')
                    ->required()
                    ->native(false),
            ]);
    }
}
