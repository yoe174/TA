<?php

namespace App\Filament\Resources\PeriodeSmarts\Tables;

use App\Models\PeriodeSmart;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class PeriodeSmartsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('label')
                    ->label('Periode')
                    ->getStateUsing(fn($record) => $record->nama_bulan . ' ' . $record->tahun)
                    ->searchable(query: function ($query, $search) {
                        $query->whereRaw("CONCAT(bulan, ' ', tahun) like ?", ["%{$search}%"]);
                    })
                    ->sortable(query: fn($query, $direction) => $query->orderBy('tahun', $direction)->orderBy('bulan', $direction)),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray'    => 'draft',
                        'success' => 'aktif',
                        'info'    => 'selesai',
                    ])
                    ->formatStateUsing(fn($state) => ucfirst($state)),

                TextColumn::make('createdBy.name')
                    ->label('Dibuat Oleh')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'draft'   => 'Draft',
                        'aktif'   => 'Aktif',
                        'selesai' => 'Selesai',
                    ]),
            ])
            ->actions([
                // // Tombol aktifkan
                // Action::make('aktifkan')
                //     ->label('Aktifkan')
                //     ->icon('heroicon-o-play')
                //     ->color('success')
                //     ->visible(fn ($record) => $record->status === 'draft')
                //     ->requiresConfirmation()
                //     ->modalHeading('Aktifkan Periode?')
                //     ->modalDescription('Hanya boleh ada 1 periode aktif. Periode lain yang aktif akan otomatis menjadi selesai.')
                //     ->action(function ($record) {
                //         // Set semua periode aktif menjadi selesai
                //         PeriodeSmart::where('status', 'aktif')->update(['status' => 'selesai']);

                //         // Aktifkan periode ini
                //         $record->update(['status' => 'aktif']);

                //         Notification::make()
                //             ->title('Periode Diaktifkan!')
                //             ->body($record->nama_bulan . ' ' . $record->tahun . ' sekarang aktif.')
                //             ->success()
                //             ->send();
                //     }),

                // // Tombol selesaikan
                // Action::make('selesaikan')
                //     ->label('Selesaikan')
                //     ->icon('heroicon-o-check-circle')
                //     ->color('info')
                //     ->visible(fn ($record) => $record->status === 'aktif')
                //     ->requiresConfirmation()
                //     ->modalHeading('Selesaikan Periode?')
                //     ->modalDescription('Periode yang sudah selesai tidak bisa diubah kembali ke aktif.')
                //     ->action(function ($record) {
                //         $record->update(['status' => 'selesai']);

                //         Notification::make()
                //             ->title('Periode Diselesaikan!')
                //             ->body($record->nama_bulan . ' ' . $record->tahun . ' telah selesai.')
                //             ->success()
                //             ->send();
                //     }),

                // Tombol Lakukan Penilaian / Proses
                Action::make('lakukan_penilaian')
                    ->label(fn($record) => $record->status === 'aktif' ? 'Proses' : 'Lakukan Penilaian')
                    ->icon(fn($record) => $record->status === 'aktif'
                        ? 'heroicon-o-arrow-right-circle'
                        : 'heroicon-o-play')
                    ->color(fn($record) => $record->status === 'aktif' ? 'info' : 'success')
                    ->visible(function ($record) {
                        // Tampil jika periode ini aktif
                        if ($record->status === 'aktif') return true;

                        // Tampil jika periode ini draft DAN tidak ada periode aktif lain
                        if ($record->status === 'draft') {
                            $adaYangAktif = PeriodeSmart::where('status', 'aktif')->exists();
                            return !$adaYangAktif;
                        }

                        return false;
                    })
                    ->action(function ($record) {
                        // Jika sudah aktif, langsung redirect
                        if ($record->status === 'aktif') {
                            redirect()->route('filament.admin.resources.penilaian-smarts.index');
                            return;
                        }

                        // Jika draft, aktifkan dulu lalu redirect
                        // Pastikan tidak ada periode aktif lain (double check backend)
                        $adaYangAktif = PeriodeSmart::where('status', 'aktif')->exists();
                        if ($adaYangAktif) {
                            Notification::make()
                                ->title('Tidak Bisa!')
                                ->body('Masih ada periode lain yang sedang diproses. Selesaikan dulu sebelum memulai periode baru.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $record->update(['status' => 'aktif']);

                        Notification::make()
                            ->title('Periode Diaktifkan!')
                            ->body('Mengarahkan ke halaman penilaian...')
                            ->success()
                            ->send();

                        redirect()->route('filament.admin.resources.penilaian-smarts.index');
                    }),

                EditAction::make()
                    ->visible(fn($record) => $record->status === 'draft'),

                DeleteAction::make()
                    ->visible(fn($record) => $record->status === 'draft'),
            ])
            ->defaultSort('tahun', 'desc')
            ->recordActions([
                // EditAction::make(),
                // Tombol Lakukan Penilaian / Proses
                Action::make('lakukan_penilaian')
                    ->label(fn($record) => $record->status === 'aktif' ? 'Proses' : 'Lakukan Penilaian')
                    ->icon(fn($record) => $record->status === 'aktif'
                        ? 'heroicon-o-arrow-right-circle'
                        : 'heroicon-o-play')
                    ->color(fn($record) => $record->status === 'aktif' ? 'info' : 'success')
                    ->visible(function ($record) {
                        // Tampil jika periode ini aktif
                        if ($record->status === 'aktif') return true;

                        // Tampil jika periode ini draft DAN tidak ada periode aktif lain
                        if ($record->status === 'draft') {
                            $adaYangAktif = PeriodeSmart::where('status', 'aktif')->exists();
                            return !$adaYangAktif;
                        }

                        return false;
                    })
                    ->action(function ($record) {
                        // Jika sudah aktif, langsung redirect
                        if ($record->status === 'aktif') {
                            redirect()->route('filament.admin.resources.penilaian-smarts.index');
                            return;
                        }

                        // Jika draft, aktifkan dulu lalu redirect
                        // Pastikan tidak ada periode aktif lain (double check backend)
                        $adaYangAktif = PeriodeSmart::where('status', 'aktif')->exists();
                        if ($adaYangAktif) {
                            Notification::make()
                                ->title('Tidak Bisa!')
                                ->body('Masih ada periode lain yang sedang diproses. Selesaikan dulu sebelum memulai periode baru.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $record->update(['status' => 'aktif']);

                        Notification::make()
                            ->title('Periode Diaktifkan!')
                            ->body('Mengarahkan ke halaman penilaian...')
                            ->success()
                            ->send();

                        redirect()->route('filament.admin.resources.penilaian-smarts.index');
                    }),

                EditAction::make()
                    ->visible(fn($record) => $record->status === 'draft'),

                DeleteAction::make()
                    ->visible(fn($record) => $record->status === 'draft'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
