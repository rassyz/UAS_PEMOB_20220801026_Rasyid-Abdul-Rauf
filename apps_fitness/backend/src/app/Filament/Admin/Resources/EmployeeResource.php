<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $modelLabel = 'Trainer';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Management Trainer';

    protected static ?int $navigationSort = -7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name', function ($query) {
                        $query->whereHas('roles', function ($roleQuery) {
                            $roleQuery->where('name', 'Personal Trainer');
                        });
                    })
                    ->required(),
                TextInput::make('name')->required(),
                TextInput::make('address')->required(),
                TextInput::make('phone')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('name'),
                TextColumn::make('address'),
                TextColumn::make('phone'),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
