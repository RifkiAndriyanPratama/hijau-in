<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Filament\Resources\LaporanResource\RelationManagers;
use App\Models\Laporan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use App\Models\User;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('pelapor.name')->label('Pelapor')->disabled(),
            TextInput::make('status')->disabled(),
            TextInput::make('lokasi')->disabled(),
            Textarea::make('keterangan')->disabled()->columnSpanFull(),
            // yang foto belum hehe
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('pelapor.name')->label('Pelapor')->searchable(),
            TextColumn::make('lokasi')->searchable(),
            BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pending',
                    'success' => 'disetujui',
                    'primary' => 'dikerjakan',
                    'danger' => 'selesai',
                ]),
            TextColumn::make('petugas.name')->label('Petugas Ditugaskan')->default('Belum ada'),
            TextColumn::make('created_at')->label('Tanggal Lapor')->dateTime()->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
    Tables\Actions\ViewAction::make(),

    // admin
    Action::make('Setujui & Tugaskan')
        ->action(function (Laporan $record, array $data): void {
            $record->update([
                'status' => 'disetujui',
                'petugas_id' => $data['petugas_id'],
                'dinas_id' => auth()->id(), // Admin (dinas) yang menyetujui
            ]);
        })
        ->form([
            Select::make('petugas_id')
                ->label('Pilih Petugas')
                ->options(
                    // Ambil semua user yang rolenya 'Petugas'
                    User::whereHas('role', fn ($q) => $q->where('nama_role', 'Petugas'))
                        ->pluck('name', 'id')
                )
                ->required(),
        ])
        ->requiresConfirmation() // modal konfirmasi
        ->color('success')
        ->icon('heroicon-o-check-circle')
        // Hanya tampilkan tombol ini jika statusnya masih 'pending'
        // dan user-nya adalah 'Admin'
        ->visible(fn (Laporan $record) => $record->status === 'pending' && auth()->user()->role->nama_role === 'Admin'),
])
        ->bulkActions([
            // Tables\Actions\BulkActionGroup::make([
            //     Tables\Actions\DeleteBulkAction::make(),
            // ]),
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
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder{
        $user = auth()->user();

        // admin liat semua tugas
        if ($user->role->nama_role === 'Admin') {
            return parent::getEloquentQuery();
        }

        // petugas
        if ($user->role->nama_role === 'Petugas') {
            return parent::getEloquentQuery()->where('petugas_id', $user->id);
        }
        
        return parent::getEloquentQuery()->where('id', 0);
    }
}
