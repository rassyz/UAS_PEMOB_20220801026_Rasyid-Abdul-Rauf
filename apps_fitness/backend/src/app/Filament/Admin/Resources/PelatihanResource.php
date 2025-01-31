<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PelatihanResource\Pages;
use App\Models\Pelatihan;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PelatihanResource extends Resource
{
    protected static ?string $model = Pelatihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'Personal Training';

    protected static ?int $navigationSort = -5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('category')->required(),
                TextInput::make('name')->required(),
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required(),
                Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required(),
                Select::make('training_type')
                    ->options([
                        'Fitness' => 'Fitness',
                        'Yoga' => 'Yoga',
                        'Pilates' => 'Pilates',
                    ]),
                Textarea::make('description'),
                DateTimePicker::make('tanggal_jam'),
                Select::make('status')
                    ->options([
                        'Upcoming' => 'Upcoming',
                        'On Progress' => 'On Progress',
                        'Finish' => 'Finish',
                    ])
                    ->default('Upcoming'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name'),
                TextColumn::make('category'),
                TextColumn::make('client.name')->label('Client'),
                TextColumn::make('employee.name')->label('Employee'),
                TextColumn::make('training_type'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50),
                TextColumn::make('tanggal_jam')
                    ->label('Jadwal Pelatihan')
                    ->dateTime('d/m/Y H:i'),
                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPelatihans::route('/'),
            'create' => Pages\CreatePelatihan::route('/create'),
            'edit' => Pages\EditPelatihan::route('/{record}/edit'),
        ];
    }
}
