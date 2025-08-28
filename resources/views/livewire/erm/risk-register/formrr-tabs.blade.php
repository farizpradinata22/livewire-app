<div x-data="{ tab: 'general' }" class="max-w-7xl mx-auto px-4 lg:px-6 py-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold">Risk Register</h1>
            <p class="text-xs text-slate-500">Tampilan: <b>Tabbed</b></p>
        </div>
        <div class="flex gap-2">
            <button type="button" wire:click="resetForm"
                    class="px-3.5 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Reset</button>
            <button type="button" wire:click="save"
                    class="px-3.5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Save Draft</button>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="border-b border-slate-200 mb-4">
        <nav class="-mb-px flex gap-6">
            <button type="button" @click="tab='general'"
                    class="py-2 border-b-2"
                    :class="tab==='general' ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-slate-500 hover:text-slate-700'">
                General Information
            </button>
            <button type="button" @click="tab='control'"
                    class="py-2 border-b-2"
                    :class="tab==='control' ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-slate-500 hover:text-slate-700'">
                Control Existing
            </button>
            <button type="button" @click="tab='inherent'"
                    class="py-2 border-b-2"
                    :class="tab==='inherent' ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-slate-500 hover:text-slate-700'">
                Inherent Risk
            </button>
        </nav>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <section x-show="tab==='general'" x-transition.opacity
                 class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <header class="px-6 py-4 border-b border-slate-100 font-semibold">General Information</header>
            <div class="p-6">@include('livewire.erm.risk-register._partials-fields')</div>
        </section>

        <section x-show="tab==='control'" x-transition.opacity
                 class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <header class="px-6 py-4 border-b border-slate-100 font-semibold">Control Existing</header>
            <div class="p-6 space-y-3">
                <textarea rows="6" wire:model.defer="control_existing"
                          class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                          placeholder="Kontrol yang sudah ada..."></textarea>
                @error('control_existing') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </section>

        <section x-show="tab==='inherent'" x-transition.opacity
                 class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <header class="px-6 py-4 border-b border-slate-100 font-semibold">Inherent Risk</header>
            <div class="p-6 space-y-3">
                <textarea rows="6" wire:model.defer="inherent_note"
                          class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                          placeholder="Catatan inherent risk..."></textarea>
                @error('inherent_note') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </section>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Save Draft</button>
        </div>
    </form>
</div>
