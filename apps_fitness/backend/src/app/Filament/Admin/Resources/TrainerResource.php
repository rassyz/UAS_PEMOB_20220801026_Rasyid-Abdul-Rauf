<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TrainerResource\Pages;
use App\Models\Trainer;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class TrainerResource extends Resource
{
    protected static ?string $model = Trainer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Management Frontend';

    protected static ?string $navigationLabel = 'Trainers';

    protected static ?int $navigationSort = -5;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Trainer Name')
                    ->required()
                    ->maxLength(255),

                Card::make()
                ->schema([
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('trainers/images')
                        ->nullable()
                        ->label('Image'),
                    ]),

                Select::make('category')
                    ->label('Trainer Category')
                    ->options([
                        'Muscle Trainer' => 'Muscle Trainer',
                        'Strength Trainer' => 'Strength Trainer',
                        'Power Trainer' => 'Power Trainer',
                        'Pilates Trainer' => 'Pilates Trainer',
                        'Yoga Trainer' => 'Yoga Trainer',
                    ])
                    ->required(),

                Textarea::make('description')
                    ->label('Description')
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Trainer Name')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->width(100)
                    ->height(100),

                TextColumn::make('category')
                    ->label('Category'),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainers::route('/'),
            'create' => Pages\CreateTrainer::route('/create'),
            'edit' => Pages\EditTrainer::route('/{record}/edit'),
        ];
    }
}
