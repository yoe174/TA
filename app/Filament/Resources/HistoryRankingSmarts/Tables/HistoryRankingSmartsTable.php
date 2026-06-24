<?php

namespace App\Filament\Resources\HistoryRankingSmarts\Tables;

// use App\Models\PeriodeSmart;
// use App\Services\HistoryRankingSmartService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
// use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
// use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Services\LaporanPdfSmartService;

class HistoryRankingSmartsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('periodeSmart.label')
                    ->label('Periode')
                    ->getStateUsing(fn($record) => $record->periodeSmart?->nama_bulan . ' ' . $record->periodeSmart?->tahun)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alternatifTerbaik.kode')
                    ->label('Kode')
                    ->searchable(),

                TextColumn::make('alternatifTerbaik.nama')
                    ->label('Peringkat 1 (Terbaik)')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('nilai_terbaik')
                    ->label('Nilai Total')
                    ->formatStateUsing(fn($state) => number_format($state, 6))
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'valid',
                        'danger'  => 'tidak_valid',
                    ])
                    ->formatStateUsing(fn($state) => $state === 'valid' ? 'Valid' : 'Tidak Valid'),

                TextColumn::make('createdBy.name')
                    ->label('Diekspor Oleh'),

                TextColumn::make('created_at')
                    ->label('Tanggal Ekspor')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'valid'       => 'Valid',
                        'tidak_valid' => 'Tidak Valid',
                    ]),
            ])
            ->recordActions([
                // EditAction::make(),
                ViewAction::make()
                    ->label('Lihat Detail'),

                // Edit status & keterangan via modal, tidak perlu halaman edit terpisah
                Action::make('edit_status')
                    ->label('Edit Status')
                    ->icon('heroicon-o-pencil')
                    ->color('warning')
                    ->form([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'valid'       => 'Valid',
                                'tidak_valid' => 'Tidak Valid',
                            ])
                            ->required()
                            ->native(false),

                        Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->rows(3)
                            ->nullable(),
                    ])
                    ->fillForm(fn($record) => [
                        'status'     => $record->status,
                        'keterangan' => $record->keterangan,
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status'     => $data['status'],
                            'keterangan' => $data['keterangan'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Status berhasil diperbarui!')
                            ->success()
                            ->send();
                    }),

                // Action cetak laporan - placeholder, akan dikembangkan setelah desain PDF
                Action::make('cetak_laporan')
                    ->label('Cetak Laporan')
                    ->icon('heroicon-o-printer')
                    ->color('gray')
                    // ->disabled() // nonaktif sementara sampai desain PDF siap
                    // ->tooltip('Fitur cetak PDF akan segera tersedia'),
                    ->action(function ($record) {
                        $service = new LaporanPdfSmartService();
                        $pdf     = $service->generate($record);

                        $fileName = 'laporan-smart-' . str_replace(' ', '-', strtolower($record->periodeSmart->nama_bulan . '-' . $record->periodeSmart->tahun)) . '.pdf';

                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            $fileName
                        );
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
