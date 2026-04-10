<?php

namespace App\Filament\Admin\Resources\Plans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Hidden::make('admin_id')
                    ->default(fn () => \Illuminate\Support\Facades\Auth::id())
                    ->required(),
                Select::make('client_request_id')
                    ->relationship(
                        'clientRequest',
                        'id',
                        fn ($query) => $query->where('status', 'pending')
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Request #{$record->id} - {$record->user->name}")
                    ->label('Client Request')
                    ->required()
                    ->unique('plans', 'client_request_id', ignoreRecord:true),
                TextInput::make('title')
                    ->required(),
                Textarea::make('diet_tips')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('training_tips')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('final_observations')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
