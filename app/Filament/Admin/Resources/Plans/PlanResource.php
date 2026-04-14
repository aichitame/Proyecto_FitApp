<?php

namespace App\Filament\Admin\Resources\Plans;

use App\Filament\Admin\Resources\Plans\Pages\CreatePlan;
use App\Filament\Admin\Resources\Plans\Pages\EditPlan;
use App\Filament\Admin\Resources\Plans\Pages\ListPlans;
use App\Models\Plan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;



class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            Section::make('Asignación del plan')
            ->schema([
                Select::make('user_id')
                ->relationship('user', 'name')
                ->label('Cliente')
                ->required()
                ->searchable(),
            
            TextInput::make('name')
            ->label('Nombre del plan')
            ->placeholder('Ej: rutina hipertrofia v1')
            ->required(),
            ])->columns(2),


            Section::make('Contenido del plan')
            ->schema([
                RichEditor::make('description')
                ->label('Instrucciones o dieta')
                ->placeholder('Escribe aquí el plan detallado...')
                ->required()
                ->columnSpanFull(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('user.name')
            ->label('Cliente')
            ->sortable()
            ->searchable(),

        TextColumn::make('name')
        ->label('Título del plan')
        ->searchable(),

        TextColumn::make('created_at')
        ->label('Fecha de creación')
        ->dateTime('d/m/Y')
        ->sortable(),
        ])
        ->filters([
        SelectFilter::make('user_id')
        ->relationship('user', 'name')
        ->label('Filtrar por cliente')
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
            'index' => ListPlans::route('/'),
            'create' => CreatePlan::route('/create'),
            'edit' => EditPlan::route('/{record}/edit'),
        ];
    }
}
