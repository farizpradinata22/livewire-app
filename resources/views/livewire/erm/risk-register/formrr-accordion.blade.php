
<div class="max-w-7xl mx-auto px-4 lg:px-6 py-6">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold">Risk Register</h1>
            <p class="text-xs text-slate-500">Tampilan: <b>Accordion</b></p>
        </div>
        <div class="flex gap-2">
            <button type="button" wire:click="resetForm"
                    class="px-3.5 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Reset</button>
            <button type="button" wire:click="save"
                    class="px-3.5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Save Draft</button>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">

        {{-- General --}}
        <section class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <button type="button" wire:click="toggle('general')"
                    class="w-full px-6 py-4 flex items-center justify-between border-b border-slate-100 hover:bg-slate-50">
                <div class="font-semibold">General Information</div>
                <svg class="h-5 w-5 text-slate-500 transition-transform"
                     :class="@js($openGeneral) ? 'rotate-180' : ''"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            @if ($openGeneral)
                <div class="p-6">
                    @include('livewire.erm.risk-register._partials-fields')
                </div>
                <div class="px-6 py-4 border-t border-slate-100 flex justify-end">
                    <button type="button" wire:click="openControl=true; openInherent=false"
                            class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Lanjut ke Control</button>
                </div>
            @endif
        </section>

        {{-- Control --}}
        <section class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <button type="button" wire:click="toggle('control')"
                    class="w-full px-6 py-4 flex items-center justify-between border-b border-slate-100 hover:bg-slate-50">
                <div class="font-semibold">Control Existing</div>
                <svg class="h-5 w-5 text-slate-500 transition-transform"
                     :class="@js($openControl) ? 'rotate-180' : ''"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            @if ($openControl)
                <div class="p-6 space-y-3">
                    <p class="text-sm text-slate-500">Catat kontrol/mitigasi yang sudah ada.</p>
                    <textarea rows="6" wire:model.defer="control_existing"
                              class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                              placeholder="Contoh: SOP incident response; monitoring; preventive maintenance; ..."></textarea>
                    @error('control_existing') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="px-6 py-4 border-t border-slate-100 flex justify-between">
                    <button type="button" wire:click="openGeneral=true"
                            class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Kembali ke General</button>
                    <button type="button" wire:click="openInherent=true"
                            class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Lanjut ke Inherent</button>
                </div>
            @endif
        </section>

        {{-- Inherent --}}
        <section class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <button type="button" wire:click="toggle('inherent')"
                    class="w-full px-6 py-4 flex items-center justify-between border-b border-slate-100 hover:bg-slate-50">
                <div class="font-semibold">Inherent Risk</div>
                <svg class="h-5 w-5 text-slate-500 transition-transform"
                     :class="@js($openInherent) ? 'rotate-180' : ''"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            @if ($openInherent)
                <div class="p-6 space-y-3">
                    <p class="text-sm text-slate-500">Catatan inherent risk (sebelum kontrol).</p>
                    <textarea rows="6" wire:model.defer="inherent_note"
                              class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                              placeholder="Tulis konteks inherent risk di sini..."></textarea>
                    @error('inherent_note') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="px-6 py-4 border-t border-slate-100 flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Save Draft</button>
                </div>
            @endif
        </section>

    </form>
</div>
