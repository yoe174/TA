<x-filament-panels::page>

    {{-- BAGIAN ALTERNATIF --}}
    <h2 class="text-lg font-bold mb-2">Alternatif</h2>
    @livewire(\App\Filament\Widgets\AlternatifStatsWidget::class)

    {{-- BAGIAN KRITERIA --}}
    <h2 class="text-lg font-bold mt-6 mb-2">Kriteria Final Saat Ini</h2>
    @livewire(\App\Filament\Widgets\NormalizationStatsWidget::class)

    {{-- TABEL KRITERIA FINAL (read only) --}}
    <div class="mt-4">
        @livewire(\App\Filament\Widgets\CriteriaFinalReadOnlyWidget::class)
    </div>

    {{-- TABEL HISTORY RANKING (read only) --}}
    <h2 class="text-lg font-bold mt-6 mb-2">Riwayat Perangkingan</h2>
    <div class="mt-4">
        @livewire(\App\Filament\Widgets\HistoryRankingReadOnlyWidget::class)
    </div>

</x-filament-panels::page>