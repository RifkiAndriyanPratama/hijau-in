<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Role;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required()->maxLength(100),
            TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
            TextInput::make('password')
                ->password()
                ->required(fn($context)=> $context==='create')
                ->dehydrateStateUsing(fn($state)=> $state ? bcrypt($state): null)
                ->visible(fn()=> in_array(strtolower(auth()->user()->role->nama_role), ['superadmin','admin'])),
            Select::make('role_id')
                ->label('Peran')
                ->options(fn()=> Role::orderBy('nama_role')->pluck('nama_role','id'))
                ->required()
                ->visible(fn()=> strtolower(auth()->user()->role->nama_role)==='superadmin'),
            // Fitur grup dihapus: select grup ditiadakan
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('role.nama_role')->label('Role')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->since()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(fn()=> in_array(strtolower(auth()->user()->role->nama_role), ['superadmin','admin'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn(User $record)=> strtolower(auth()->user()->role->nama_role) === 'superadmin' 
                        && strtolower($record->role->nama_role) !== 'superadmin'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn()=> strtolower(auth()->user()->role->nama_role)==='superadmin'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
