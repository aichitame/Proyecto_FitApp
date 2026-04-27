<?php

namespace App\Filament\Admin\Resources\ClientRequests\Schemas;

use Filament\Forms\Components\CheckboxList;
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
                            ->searchable()
                            ->preload()
                            ->required()
                            ->disabledOn('edit'),

                        TextInput::make('age')
                            ->label('Edad')
                            ->required()
                            ->numeric()
                            ->minValue(1),

                        Select::make('gender')
                            ->label('Sexo')
                            ->options([
                                'Femenino' => 'Femenino',
                                'Masculino' => 'Masculino',
                                'Prefiero no decirlo' => 'Prefiero no decirlo',
                            ])
                            ->required()
                            ->native(false),

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
                    ]),

                Section::make('Actividad física')
                    ->schema([
                        Select::make('physical_activity_frequency')
                            ->label('Frecuencia de actividad física')
                            ->options([
                                'none' => 'Ninguna',
                                '1_2_days' => '1-2 días por semana',
                                '3_4_days' => '3-4 días por semana',
                                '5_plus_days' => '5 o más días por semana',
                            ])
                            ->required()
                            ->native(false),

                        CheckboxList::make('physical_activity_type')
                            ->label('Tipo de actividad física')
                            ->options([
                                'walking' => 'Caminar',
                                'running' => 'Running',
                                'gym' => 'Gimnasio',
                                'cycling' => 'Ciclismo',
                                'yoga_pilates' => 'Yoga / Pilates',
                                'swimming' => 'Natación',
                                'team_sports' => 'Deportes de equipo',
                                'other' => 'Otro',
                            ])
                            ->columns(2),

                        Textarea::make('physical_limitations')
                            ->label('Limitaciones físicas')
                            ->rows(3),
                    ]),

                Section::make('Objetivo y estado')
                    ->schema([
                        Textarea::make('goal')
                            ->label('Objetivo')
                            ->required()
                            ->rows(3),

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
                            ->required()
                            ->native(false),

                        Textarea::make('rejection_reason')
                            ->label('Motivo de rechazo')
                            ->rows(3)
                            ->visible(fn (Get $get): bool => $get('status') === 'rejected')
                            ->required(fn (Get $get): bool => $get('status') === 'rejected'),
                    ]),
            ]);
    }
}