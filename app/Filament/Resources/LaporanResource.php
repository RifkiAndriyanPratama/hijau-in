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
use Filament\Forms\Components\FileUpload;
use App\Enums\LaporanStatus;
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
        return $form->schema([
            // Pelapor otomatis di-set ke user yang sedang login pada create
            Select::make('tipe_masalah')
                ->label('Tipe Masalah')
                ->options(collect(\App\Models\Laporan::TIPE_MASALAH)->mapWithKeys(fn($v)=>[$v => ucwords(str_replace('_',' ',$v))]))
                ->required(),
            Select::make('status')
                ->label('Status')
                ->options(fn($get)=> collect(LaporanStatus::tryFrom($get('status'))? LaporanStatus::tryFrom($get('status'))->next(): [LaporanStatus::Pending])->mapWithKeys(fn($s)=>[$s->value => ucfirst($s->value)]))
                ->default(LaporanStatus::Pending->value)
                ->disabled(fn($context)=>$context==='create')
                ->dehydrated()
                ->reactive(),
            TextInput::make('lokasi')->required()->maxLength(255),
            Textarea::make('keterangan')->required()->columnSpanFull(),
            Select::make('petugas_id')
                ->label('Penanggung Jawab')
                ->options(User::whereHas('role', fn($q)=>$q->whereIn('nama_role',['Admin','Superadmin']))->pluck('name','id'))
                ->searchable()
                ->visible(fn($get)=> in_array($get('status'), [LaporanStatus::Disetujui->value, LaporanStatus::Dikerjakan->value]))
                ->nullable()
                ->helperText('Dipilih dari Admin/Superadmin sebagai eksekutor.'),
            FileUpload::make('photos')
                ->label('Foto Laporan')
                ->multiple()
                ->maxFiles(5)
                ->directory('laporan')
                ->disk('public')
                ->image()
                ->preserveFilenames()
                ->maxSize(2048) // KB
                ->helperText('Format: jpg/png, maks 5 file, 2MB tiap file')
                ->dehydrated(false) // jangan simpan ke kolom model (tidak ada kolom photos)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('pelapor.name')->label('Pelapor')->searchable(),
            TextColumn::make('lokasi')->searchable(),
            // Kolom grup dihapus karena fitur grup dinonaktifkan
            TextColumn::make('tipe_masalah')->label('Tipe')->badge(),
            BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pending',
                    'success' => 'disetujui',
                    'primary' => 'dikerjakan',
                    'danger' => 'selesai',
                ]),
            TextColumn::make('petugas.name')->label('Penanggung Jawab')->default('Belum ada'),
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
                'status' => LaporanStatus::Disetujui->value,
                'petugas_id' => $data['petugas_id'],
                'dinas_id' => auth()->id(),
            ]);
        })
        ->form([
            Select::make('petugas_id')
                ->label('Pilih Penanggung Jawab')
                ->options(User::whereHas('role', fn ($q) => $q->whereIn('nama_role',['Admin','Superadmin']))->pluck('name','id'))
                ->required(),
        ])
        ->visible(fn (Laporan $record) => $record->status->value === LaporanStatus::Pending->value && in_array(strtolower(auth()->user()->role->nama_role), ['admin','superadmin']))
        ->color('success')
        ->icon('heroicon-o-check-circle'),
    Action::make('Mulai Kerjakan')
        ->action(fn(Laporan $record) => $record->update(['status'=> LaporanStatus::Dikerjakan->value]))
        ->visible(fn(Laporan $record)=> $record->status->value === LaporanStatus::Disetujui->value && (auth()->id()===$record->petugas_id))
        ->color('primary')
        ->icon('heroicon-o-play'),
    Action::make('Tandai Selesai')
        ->action(fn(Laporan $record)=> $record->update(['status'=> LaporanStatus::Selesai->value]))
        ->visible(fn(Laporan $record)=> $record->status->value === LaporanStatus::Dikerjakan->value && (auth()->id()===$record->petugas_id || in_array(strtolower(auth()->user()->role->nama_role), ['admin','superadmin'])))
        ->color('danger')
        ->icon('heroicon-o-check'),
    Action::make('Restore')
        ->action(fn(Laporan $record)=> $record->restore())
        ->visible(fn(Laporan $record)=> $record->trashed() && strtolower(auth()->user()->role->nama_role)==='superadmin')
        ->color('secondary')
        ->icon('heroicon-o-arrow-path'),
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

    public static function getEloquentQuery(): Builder
    {
        // Semua user sekarang dapat melihat seluruh laporan (fitur grup dinonaktifkan)
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
