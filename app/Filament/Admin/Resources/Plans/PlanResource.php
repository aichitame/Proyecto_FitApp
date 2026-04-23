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
                Section::make('Asignación y control')
                    ->description('Vincula el plan a una solicitud y define su estado de publicación.')
                    ->schema([
                        Select::make('client_request_id')
                            ->relationship('clientRequest', 'id')
                            ->label('Solicitud')
                            ->getOptionLabelFromRecordUsing(
                                fn ($record) => 'Solicitud #'.$record->id
                                . ' - '.($record->user?->name ?? 'Sin cliente')
                                . ' - '.match ($record->status) {
                                    'pending' => 'Pendiente',
                                    'in_review' => 'En revisión',
                                    'completed' => 'Completada',
                                    'rejected' => 'Rechazada',
                                    default => $record->status,
                                }
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->label('Nombre del plan')
                            ->placeholder('Ej: Plan orientativo mayo 2026')
                            ->required()
                            ->maxLength(255),

                        Select::make('status')
                        ->label('Estado del plan')
                        ->options([
                            'draft' => 'Borrador',
                            'published' => 'Publicado',
                        ])
                        ->default('draft')
                        ->required()
                        ->native(false),
                    ])
                    ->columns([
                        'md' => 2,
                        'xl' => 3,
                    ])
                    ->columnSpanFull(),

                Section::make('Contenido del plan')
                    ->description('Redacta aquí el contenido que verá el cliente cuando el plan sea publicado. Puedes incluir recomendaciones de alimentación, actividad física, observaciones y pautas generales.')
                    ->schema([
                        RichEditor::make('description')
                            ->label('Contenido del plan orientativo')
                            ->placeholder('Empieza a escribir el plan...')
                            ->required()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike'],
                                ['h2', 'h3'],
                                ['bulletList', 'orderedList'],
                                ['blockquote', 'redo', 'undo'],
                                ['link'],
                            ])
                            ->columnSpanFull()
                            ->extraInputAttributes([
                                'style' => 'min-height: 420px;',
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
}

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('clientRequest.id')
            ->label('Solicitud')
            ->sortable(),

        TextColumn::make('clientRequest.user.name')
        ->label('Cliente')
        ->sortable()
        ->searchable(),

        TextColumn::make('name')
        ->label('Título del plan')
        ->searchable(),

        TextColumn::make('version')
        ->label('Versión')
        ->badge()
        ->sortable(),

        TextColumn::make('status')
        ->label('Estado')
        ->badge()
        ->color(fn (string $state): string => match ($state){
            'draft' => 'warning',
            'published' => 'success',
            default => 'gray',
        })
        ->sortable(),

        TextColumn::make('published_at')
        ->label('Publicado el')
        ->dateTime('d/m/Y H:i')
        ->placeholder('-')
        ->sortable(),

        TextColumn::make('created_at')
        ->label('Fecha de creación')
        ->dateTime('d/m/Y H:i')
        ->sortable(),

        ])
        ->filters([
        SelectFilter::make('status')
        ->label('Estado del plan')
        ->options([
            'draft' => 'Borrador',
            'published' => 'Publicado'
        ]),

        SelectFilter::make('client_request_status')
        ->label('Estado de la solicitud')
        ->relationship('clientRequest', 'status')
        ->options([
            'pending' => 'Pendiente',
            'in_review' => 'En revisión',
            'completed' => 'Completada',
            'rejected' => 'Rechazada',
        ]),
    ]);
    }

    public static function getRelations(): array
    {
        return [];
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
