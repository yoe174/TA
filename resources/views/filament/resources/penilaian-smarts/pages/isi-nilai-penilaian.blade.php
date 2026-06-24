<x-filament-panels::page>
    <form wire:submit="simpan">
        {{ $this->form }}

        <div class="mt-6 flex justify-end">
            <x-filament::button type="submit" color="success" icon="heroicon-o-check">
                Simpan Nilai
            </x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
