<?php

// namespace App\Filament\Resources\PenilaianSmarts\Pages;

// use App\Filament\Resources\PenilaianSmarts\PenilaianSmartResource;
// use Filament\Actions\DeleteAction;
// use Filament\Resources\Pages\EditRecord;

// class IsNilaiPenilaian extends EditRecord
// {
//     protected static string $resource = PenilaianSmartResource::class;

//     protected function getHeaderActions(): array
//     {
//         return [
//             DeleteAction::make(),
//         ];
//     }
// }

namespace App\Filament\Resources\PenilaianSmarts\Pages;

use App\Filament\Resources\PenilaianSmarts\PenilaianSmartResource;
use App\Models\AlternatifSmart;
use App\Models\CriteriaSmart;
use App\Models\ParameterSmart;
use App\Models\PenilaianSmart;
use App\Models\PeriodeSmart;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Auth;
use Filament\Schemas\Schema;

class IsiNilaiPenilaian extends Page
{

    use InteractsWithForms;

    protected static string $resource = PenilaianSmartResource::class;
    protected string $view     = 'filament.resources.penilaian-smarts.pages.isi-nilai-penilaian';

    public ?AlternatifSmart $alternatif = null;
    public ?PeriodeSmart $periode       = null;
    public array $data                  = [];

    public function mount(int $alternatifId): void
    {
        $this->periode    = PeriodeSmart::where('status', 'aktif')->firstOrFail();
        $this->alternatif = AlternatifSmart::findOrFail($alternatifId);

        // Load nilai yang sudah ada
        $existingData = [];
        $criterias = CriteriaSmart::orderBy('kode')->get();

        foreach ($criterias as $crit) {
            $penilaian = PenilaianSmart::where('periode_smart_id', $this->periode->id)
                ->where('alternatif_smart_id', $alternatifId)
                ->where('criteria_smart_id', $crit->id)
                ->first();

            if ($crit->use_parameter) {
                $existingData["kriteria_{$crit->id}"] = $penilaian?->parameter_smart_id;
            } else {
                $existingData["kriteria_{$crit->id}"] = $penilaian?->nilai_manual;
            }
        }

        $this->form->fill($existingData);
    }

    public function form(Schema $form): Schema
    {
        $criterias  = CriteriaSmart::orderBy('kode')->get();
        $components = [];

        foreach ($criterias as $crit) {
            $jenis = strtoupper($crit->jenis);

            if ($crit->use_parameter) {
                $components[] = Select::make("kriteria_{$crit->id}")
                    ->label("{$crit->kode} — {$crit->nama_kriteria} ({$jenis})")
                    ->options(
                        ParameterSmart::where('criteria_smart_id', $crit->id)
                            ->orderBy('nilai', 'desc')
                            ->get()
                            ->mapWithKeys(fn($p) => [$p->id => "{$p->nilai}).  {$p->label}"])
                    )
                    ->native(false)
                    ->searchable()
                    ->required();
            } else {
                $components[] = TextInput::make("kriteria_{$crit->id}")
                    ->label("{$crit->kode} — {$crit->nama_kriteria} ({$jenis})")
                    ->numeric()
                    ->minValue(0)
                    ->required();
            }
        }

        return $form->schema([
            Section::make("Penilaian: {$this->alternatif?->nama}")
                ->description("Periode: {$this->periode?->nama_bulan} {$this->periode?->tahun}")
                ->schema($components)
                ->columns(2),
        ])->statePath('data');
    }

    public function simpan(): void
    {
        $data      = $this->form->getState();
        $criterias = CriteriaSmart::orderBy('kode')->get();

        foreach ($criterias as $crit) {
            $value = $data["kriteria_{$crit->id}"] ?? null;

            PenilaianSmart::updateOrCreate(
                [
                    'periode_smart_id'    => $this->periode->id,
                    'alternatif_smart_id' => $this->alternatif->id,
                    'criteria_smart_id'   => $crit->id,
                ],
                [
                    'parameter_smart_id' => $crit->use_parameter ? $value : null,
                    'nilai_manual'       => !$crit->use_parameter ? $value : null,
                    'created_by'         => Auth::id(),
                ]
            );
        }

        Notification::make()
            ->title('Nilai Berhasil Disimpan!')
            ->body("Penilaian {$this->alternatif->nama} telah tersimpan.")
            ->success()
            ->send();

        // redirect($this->getResource()::getUrl('index'));
        redirect()->to($this->getResource()::getUrl('index'));
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('kembali')
                ->label('Kembali')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
