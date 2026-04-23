<?php

namespace App\Filament\Admin\Resources\ClientRequests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClientRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cliente y datos básicos')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Cliente')
                            ->required(),

                        TextInput::make('age')
                            ->label('Edad')
                            ->required()
                            ->numeric()
                            ->minValue(1),

                        TextInput::make('gender')
                            ->label('Sexo')
                            ->required(),

                        TextInput::make('height')
                            ->label('Altura (cm)')
                            ->required()
                            ->numeric()
                            ->minValue(1),

                        TextInput::make('weight')
                            ->label('Peso (kg)')
                            ->required()
                            ->numeric()
                            ->minValue(1),
                    ])
                    ->columns(2),

                Section::make('Hábitos alimenticios')
                    ->schema([
                        Textarea::make('eating_habits')
                            ->label('Hábitos alimenticios')
                            ->required()
                            ->rows(4),

                        Select::make('has_allergies')
                            ->label('¿Tiene alergias o intolerancias?')
                            ->options([
                                0 => 'No',
                                1 => 'Sí',
                            ])
                            ->default(0)
                            ->required()
                            ->native(false)
                            ->live(),

                        Textarea::make('allergies_description')
                            ->label('Descripción de alergias o intolerancias')
                            ->rows(3)
                            ->required(fn (Get $get): bool => (bool) $get('has_allergies'))
                            ->visible(fn (Get $get): bool => (bool) $get('has_allergies')),
                    ])
                    ->columns(1),

                Section::make('Actividad física')
                    ->schema([
                        TextInput::make('physical_activity_frequency')
                            ->label('Frecuencia de actividad física')
                            ->required(),

                        Textarea::make('physical_activity_type')
                            ->label('Tipo de actividad física')
                            ->required()
                            ->rows(3),

                        Textarea::make('physical_limitations')
                            ->label('Limitaciones físicas')
                            ->rows(3),
                    ])
                    ->columns(1),

                Section::make('Objetivo y estado')
                    ->schema([
                        TextInput::make('goal')
                            ->label('Objetivo')
                            ->required(),

                        Textarea::make('additional_observations')
                            ->label('Observaciones adicionales')
                            ->rows(4),

                        Select::make('orientative_service_acknowledged')
                            ->label('Servicio orientativo aceptado')
                            ->options([
                                false => 'No',
                                true => 'Sí',
                            ])
                            ->required()
                            ->native(false),
                        
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'pending' => 'Pendiente',
                                'in_review' => 'En revisión',
                                'completed' => 'Completada',
                                'rejected' => 'Rechazada',
                            ])
                            ->default('pending')
                            ->visibleOn('edit')
                            ->required()
                            ->native(false),
                    ])
                    ->columns(1),
            ]);
    }
}
