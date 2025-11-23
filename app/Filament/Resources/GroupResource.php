<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\User;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    // Navigation disembunyikan karena fitur grup dinonaktifkan
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->unique(ignoreRecord: true)
                ->disabled(fn($context)=> $context==='edit' && strtolower(auth()->user()->role->nama_role) !== 'superadmin'),
            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('Unik, tanpa spasi.')
                ->disabled(fn($context)=> $context==='edit' && strtolower(auth()->user()->role->nama_role) !== 'superadmin'),
            Textarea::make('description')->columnSpanFull(),
            Select::make('group_admins')
                ->label('Admin Grup')
                ->multiple()
                ->options(User::whereHas('role', fn($q)=> $q->where('nama_role','Admin'))
                    ->pluck('name','id'))
                ->visible(fn()=> strtolower(auth()->user()->role->nama_role) === 'superadmin')
                ->helperText('Pilih admin grup (khusus superadmin).'),
            Select::make('users')
                ->multiple()
                ->relationship('users','name')
                ->options(function() {
                    $role = strtolower(auth()->user()->role->nama_role);
                    if ($role === 'superadmin') {
                        return User::pluck('name','id');
                    }
                    // admin hanya bisa menambah masyarakat
                    return User::whereHas('role', fn($q)=> $q->where('nama_role','Masyarakat'))
                        ->pluck('name','id');
                })
                ->preload()
                ->searchable()
                ->label('Anggota')
                ->helperText('Admin: hanya masyarakat. Superadmin: semua user.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('slug'),
            Tables\Columns\TextColumn::make('users_count')->counts('users')->label('Anggota'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        // Kembalikan query kosong agar halaman (jika diakses langsung) tidak menampilkan data
        return parent::getEloquentQuery()->where('id',0);
    }

    public static function getPages(): array
    {
        // Kosongkan halaman karena fitur dinonaktifkan
        return [];
    }
}
