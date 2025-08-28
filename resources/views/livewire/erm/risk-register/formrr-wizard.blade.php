<div x-data="{ step: @entangle('step') }" class="max-w-7xl mx-auto px-4 lg:px-6 py-6">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold">Risk Register</h1>
            <p class="text-xs text-slate-500">Tampilan: <b>Wizard / Stepper</b></p>
        </div>
        <div class="flex gap-2">
            <button type="button" wire:click="resetForm"
                    class="px-3.5 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Reset</button>
            <button type="button" wire:click="save"
                    class="px-3.5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Save Draft</button>
        </div>
    </div>

    {{-- Stepper --}}
    <ol class="mb-6 flex items-center justify-between gap-2">
        @php $labels = [1=>'General Information', 2=>'Control Existing', 3=>'Inherent Risk']; @endphp
        @foreach ($labels as $i => $label)
            <li class="flex-1">
                <button type="button" @click="step={{ $i }}" class="w-full">
                    <div class="flex items-center">
                        <div class="h-9 w-9 flex items-center justify-center rounded-full border
                                    {{ $step > $i ? 'bg-indigo-600 border-indigo-600 text-white' : ($step === $i ? 'bg-white border-indigo-600 text-indigo-700 ring-2 ring-indigo-200' : 'bg-white border-slate-300 text-slate-500') }}">
                            <span class="text-sm font-semibold">{{ $i }}</span>
                        </div>
                        <span class="ml-3 text-sm font-medium {{ $step >= $i ? 'text-slate-900' : 'text-slate-500' }}">{{ $label }}</span>
                    </div>
                    @if ($i < 3)
                        <div class="h-1 w-full mt-2 rounded-full {{ $step > $i ? 'bg-indigo-600' : 'bg-slate-200' }}"></div>
                    @endif
                </button>
            </li>
        @endforeach
    </ol>

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-8">

        {{-- Step 1 --}}
        <section x-show="step===1" x-transition.opacity.scale.origin.top
                 class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <header class="px-6 py-4 border-b border-slate-100 font-semibold">General Information</header>
            <div class="p-6">
                @include('livewire.erm.risk-register._partials-fields')
            </div>
            <div class="px-6 py-4 border-t border-slate-100 flex justify-end">
                <button type="button" wire:click="nextStep"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Next</button>
            </div>
        </section>

        {{-- Step 2 --}}
        <section x-show="step===2" x-transition.opacity.scale.origin.top
                 class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <header class="px-6 py-4 border-b border-slate-100 font-semibold">Control Existing</header>
            <div class="p-6 space-y-3">
                <textarea rows="6" wire:model.defer="control_existing"
                          class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                          placeholder="Kontrol yang sudah ada..."></textarea>
                @error('control_existing') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="px-6 py-4 border-t border-slate-100 flex justify-between">
                <button type="button" wire:click="prevStep"
                        class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Back</button>
                <button type="button" wire:click="nextStep"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Next</button>
            </div>
        </section>

        {{-- Step 3 --}}
        <section x-show="step===3" x-transition.opacity.scale.origin.top
                 class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <header class="px-6 py-4 border-b border-slate-100 font-semibold">Inherent Risk</header>
            <div class="p-6 space-y-3">
                <textarea rows="6" wire:model.defer="inherent_note"
                          class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                          placeholder="Catatan inherent risk..."></textarea>
                @error('inherent_note') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="px-6 py-4 border-t border-slate-100 flex justify-between">
                <button type="button" wire:click="prevStep"
                        class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Back</button>
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Save Draft</button>
            </div>
        </section>
    </form>
</div>
