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
                    ->label('Customer')
                    ->required(),
                TextInput::make('age')
                    ->required()
                    ->numeric(),
                TextInput::make('gender')
                    ->required(),
                TextInput::make('height')
                    ->required()
                    ->numeric(),
                TextInput::make('weight')
                    ->required()
                    ->numeric(),
                TextInput::make('goal')
                    ->required(),
                TextInput::make('activity_level')
                    ->required(),
                TextInput::make('training_days')
                    ->required()
                    ->numeric(),
                TextInput::make('food_preference')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'processing' => 'In Progress',
                    'completed' => 'Completed',
                ])
                    ->default('pending')
                    ->required()
                    ->native(false),
            ]);
    }
}
