{{-- Dipanggil dengan: @include('livewire.erm.risk-register._partials-fields') --}}
{{-- Pastikan properti Livewire yang digunakan sudah ada di komponen --}}
<div class="space-y-6">
    {{-- Judul --}}
    <div>
        <label class="block text-sm font-medium text-slate-700">
            Risk Title <span class="text-rose-600">*</span>
        </label>
        <input type="text" wire:model.defer="title"
               class="mt-1 w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
               placeholder="Contoh: Gangguan Layanan DC Area X">
        @error('title') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Description --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Risk Description</label>
            <textarea rows="7" wire:model.defer="description"
                      class="mt-1 w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                      placeholder="Jelaskan risiko secara ringkas..."></textarea>
            @error('description') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Cause (auto-number) --}}
        <div
            x-data="{
                init(){ this.ensureStarts() },
                ensureStarts(){
                    const ta=$refs.ta
                    if((ta.value||'').trim()===''){ ta.value='1. '; const l=ta.value.length; ta.setSelectionRange(l,l); ta.dispatchEvent(new Event('input'));}
                },
                insertNumber(){
                    const ta=$refs.ta, v=ta.value, lines=v.split(/\n/), next=lines.length+1
                    const s=ta.selectionStart, e=ta.selectionEnd
                    const before=v.slice(0,s), after=v.slice(e), add='\n'+next+'. '
                    ta.value=before+add+after; const pos=(before+add).length
                    ta.setSelectionRange(pos,pos); ta.dispatchEvent(new Event('input'))
                }
            }"
            x-init="init()"
        >
            <label class="block text-sm font-medium text-slate-700">Risk Cause</label>
            <textarea x-ref="ta" rows="7" wire:model.defer="cause"
                      @focus="ensureStarts()" @keydown.enter.prevent="insertNumber()"
                      class="mt-1 w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                      placeholder="1. "></textarea>
            @error('cause') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Type --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Risk Type</label>
            <select wire:model.defer="type"
                    class="mt-1 w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                <option value="">— pilih —</option>
                @foreach(($types ?? []) as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                @endforeach
            </select>
            @error('type') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Taxonomy --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Risk Taxonomy</label>
            <select wire:model.defer="taxonomy"
                    class="mt-1 w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                <option value="">— pilih —</option>
                @foreach(($taxonomies ?? []) as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                @endforeach
            </select>
            @error('taxonomy') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- ISO (checkbox) --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-2">ISO Category</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                @forelse(($isoCategories ?? []) as $opt)
                    <label class="flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-2 hover:bg-slate-50">
                        <input type="checkbox" value="{{ $opt }}" wire:model.defer="iso_selected"
                               class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-slate-700">{{ $opt }}</span>
                    </label>
                @empty
                    <p class="text-slate-500 text-sm">Belum ada opsi ISO Category.</p>
                @endforelse
            </div>
        </div>

        {{-- Source --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Risk Source</label>
            <select wire:model.defer="source"
                    class="mt-1 w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                <option value="">— pilih —</option>
                @foreach(($sources ?? []) as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                @endforeach
            </select>
            @error('source') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Owner --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Risk Owner</label>
            <input type="text" wire:model.defer="owner"
                   class="mt-1 w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                   placeholder="Unit/Person in charge">
            @error('owner') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
