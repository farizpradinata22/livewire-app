{{-- resources/views/livewire/erm/risk-register/form.blade.php --}}
{{-- WIZARD 3 LANGKAH dengan form modern: floating label, searchable select, chip checkbox. --}}

<div x-data="{ step: 1 }" class="w-full">

    {{-- Top action bar --}}
    <div class="sticky top-0 z-20 -mx-4 md:-mx-6 px-4 md:px-6 py-3 mb-4 bg-white/90 backdrop-blur border-b border-slate-200">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12 3l7.5 3v6c0 4.418-3.134 8.363-7.5 9-4.366-.637-7.5-4.582-7.5-9V6L12 3z"/>
                </svg>
                <div>
                    <h1 class="text-lg md:text-xl font-semibold leading-tight">Risk Register</h1>
                    <p class="text-xs text-slate-500">Wizard: General → Control → Inherent</p>
                </div>
            </div>
            <div class="flex gap-2">
                <button type="button" wire:click="resetForm" class="px-3.5 py-2 rounded-lg border border-slate-300 hover:bg-slate-50 text-slate-700">Reset</button>
                <button type="button" x-on:click="if(step<3) step++" class="px-3.5 py-2 rounded-lg bg-sky-600 text-white hover:bg-sky-700 shadow-sm">Save & Next</button>
                <button type="button" wire:click="save" class="px-3.5 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm">Save</button>
            </div>
        </div>
    </div>

    {{-- Flash --}}
    @if (session('success'))
        <div class="max-w-7xl mx-auto mb-4 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Layout: sidebar (kiri) + konten (kanan) --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-6">
        {{-- Sidebar Steps --}}
        <aside class="lg:col-span-3">
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                <div class="px-4 py-3 border-b border-slate-100">
                    <p class="text-sm font-semibold text-slate-700">Sections</p>
                </div>

                @php
                    $items = [
                        1 => ['title' => 'General',   'desc' => 'Informasi umum'],
                        2 => ['title' => 'Control',   'desc' => 'Kontrol existing'],
                        3 => ['title' => 'Inherent',  'desc' => 'Inherent risk'],
                    ];
                @endphp

                <nav class="p-2">
                    @foreach ($items as $i => $meta)
                        <button type="button" @click="step={{ $i }}"
                            class="w-full mb-2 last:mb-0 text-left rounded-xl px-3 py-3 transition border flex items-start gap-3"
                            :class="step==={{ $i }} ? 'bg-sky-50/70 border-sky-200 ring-1 ring-sky-100' : 'bg-white hover:bg-slate-50 border-slate-200'">
                            <div class="mt-0.5">
                                <div class="w-5 h-5 rounded-full flex items-center justify-center border"
                                     :class="step>={{ $i }} ? 'bg-sky-600 border-sky-600 text-white' : 'bg-white border-slate-300 text-slate-400'">
                                    <span class="text-[11px] font-semibold">{{ $i }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm font-medium" :class="step>={{ $i }} ? 'text-slate-900' : 'text-slate-600'">{{ $meta['title'] }}</div>
                                <div class="text-xs text-slate-500">{{ $meta['desc'] }}</div>
                            </div>
                        </button>
                    @endforeach
                </nav>
            </div>
        </aside>

        {{-- KONTEN FORM --}}
        <section class="lg:col-span-9">
            <form wire:submit.prevent="save" class="space-y-6">

                {{-- ============ STEP 1: GENERAL (Modern form) ============ --}}
                <div x-show="step===1" x-transition.opacity.scale.origin.top class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                    <header class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m0-8h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                        </svg>
                        <h2 class="text-base font-semibold">General Information</h2>
                    </header>

                    <div class="p-6 space-y-6">

                        {{-- Floating: Risk Title --}}
                        <div class="relative">
                            <input type="text" id="title" wire:model.defer="title"
                                   class="peer w-full rounded-xl border border-slate-300 bg-white px-3.5 py-3 placeholder-transparent
                                          focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                                   placeholder="Risk Title">
                            <label for="title"
                                   class="pointer-events-none absolute left-3.5 top-3.5 px-1 text-slate-500 transition-all
                                          peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-slate-400
                                          peer-focus:-top-2 peer-focus:text-xs peer-focus:text-sky-600 bg-white">
                                Risk Title <span class="text-rose-600">*</span>
                            </label>
                            @error('title') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                            <p class="text-xs text-slate-400 mt-1">Contoh: Gangguan Layanan DC Area X</p>
                        </div>

                        {{-- Description & Cause --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Floating: Description --}}
                            <div class="relative">
                                <textarea id="desc" rows="7" wire:model.defer="description"
                                          class="peer w-full rounded-xl border border-slate-300 bg-white px-3.5 py-3 placeholder-transparent
                                                 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                                          placeholder="Risk Description"></textarea>
                                <label for="desc"
                                       class="pointer-events-none absolute left-3.5 top-3.5 px-1 text-slate-500 transition-all
                                              peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-slate-400
                                              peer-focus:-top-2 peer-focus:text-xs peer-focus:text-sky-600 bg-white">
                                    Risk Description
                                </label>
                                @error('description') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Floating + Auto-number: Cause --}}
                            <div class="relative"
                                 x-data="{
                                    init(){ this.ensureStarts() },
                                    ensureStarts(){
                                        const ta=$refs.ta
                                        if((ta.value||'').trim()===''){ ta.value='1. '; const l=ta.value.length; ta.setSelectionRange(l,l); ta.dispatchEvent(new Event('input'));}
                                    },
                                    insertNumber(){
                                        const ta=$refs.ta, v=ta.value, lines=v.split(/\\n/), next=lines.length+1
                                        const s=ta.selectionStart, e=ta.selectionEnd, before=v.slice(0,s), after=v.slice(e)
                                        const add='\\n'+next+'. '; ta.value=before+add+after
                                        const pos=(before+add).length; ta.setSelectionRange(pos,pos); ta.dispatchEvent(new Event('input'))
                                    }
                                 }"
                                 x-init="init()"
                            >
                                <textarea x-ref="ta" id="cause" rows="7" wire:model.defer="cause"
                                          @focus="ensureStarts()" @keydown.enter.prevent="insertNumber()"
                                          class="peer w-full rounded-xl border border-slate-300 bg-white px-3.5 py-3 placeholder-transparent
                                                 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                                          placeholder="Risk Cause"></textarea>
                                <label for="cause"
                                       class="pointer-events-none absolute left-3.5 top-3.5 px-1 text-slate-500 transition-all
                                              peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-slate-400
                                              peer-focus:-top-2 peer-focus:text-xs peer-focus:text-sky-600 bg-white">
                                    Risk Cause
                                </label>
                                @error('cause') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Searchable Select + Chips --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Searchable: Risk Type --}}
                            <div x-data="selectSearch({ options: @js($types ?? []), value: @entangle('type') })" class="relative">
                                <input type="hidden" wire:model.defer="type" x-model="value">
                                <div @click="open=!open" class="rounded-xl border border-slate-300 px-3.5 py-3 cursor-pointer hover:bg-slate-50
                                                               focus-within:border-sky-500 focus-within:ring-2 focus-within:ring-sky-200">
                                    <label class="block text-xs text-slate-500 -mt-1 mb-1">Risk Type</label>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-800" x-text="value || '— pilih —'"></span>
                                        <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                                <div x-show="open" @click.outside="open=false" x-transition
                                     class="absolute z-10 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg p-2">
                                    <input type="text" x-model="q" placeholder="Cari..."
                                           class="w-full rounded-lg border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 px-3 py-2 mb-2">
                                    <div class="max-h-48 overflow-auto space-y-1">
                                        <template x-for="opt in filtered()" :key="opt">
                                            <button type="button" @click="choose(opt)"
                                                    class="w-full text-left px-3 py-2 rounded-md hover:bg-sky-50">
                                                <span x-text="opt"></span>
                                            </button>
                                        </template>
                                        <p class="text-sm text-slate-400 px-3 py-2" x-show="filtered().length===0">Tidak ada hasil</p>
                                    </div>
                                </div>
                                @error('type') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Searchable: Risk Taxonomy --}}
                            <div x-data="selectSearch({ options: @js($taxonomies ?? []), value: @entangle('taxonomy') })" class="relative">
                                <input type="hidden" wire:model.defer="taxonomy" x-model="value">
                                <div @click="open=!open" class="rounded-xl border border-slate-300 px-3.5 py-3 cursor-pointer hover:bg-slate-50
                                                               focus-within:border-sky-500 focus-within:ring-2 focus-within:ring-sky-200">
                                    <label class="block text-xs text-slate-500 -mt-1 mb-1">Risk Taxonomy</label>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-800" x-text="value || '— pilih —'"></span>
                                        <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                                <div x-show="open" @click.outside="open=false" x-transition
                                     class="absolute z-10 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg p-2">
                                    <input type="text" x-model="q" placeholder="Cari..."
                                           class="w-full rounded-lg border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 px-3 py-2 mb-2">
                                    <div class="max-h-48 overflow-auto space-y-1">
                                        <template x-for="opt in filtered()" :key="opt">
                                            <button type="button" @click="choose(opt)" class="w-full text-left px-3 py-2 rounded-md hover:bg-sky-50">
                                                <span x-text="opt"></span>
                                            </button>
                                        </template>
                                        <p class="text-sm text-slate-400 px-3 py-2" x-show="filtered().length===0">Tidak ada hasil</p>
                                    </div>
                                </div>
                                @error('taxonomy') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Chips: ISO Category (multi) --}}
                            <div class="md:col-span-2">
                                <label class="block text-xs text-slate-500 mb-2">ISO Category</label>
                                <div class="flex flex-wrap gap-2">
                                    @forelse(($isoCategories ?? []) as $opt)
                                        <label class="inline-flex items-center gap-2">
                                            <input type="checkbox" value="{{ $opt }}" wire:model.defer="iso_selected"
                                                   class="hidden peer">
                                            <span class="px-3 py-1.5 rounded-full border text-sm
                                                         border-slate-300 text-slate-700 bg-white
                                                         peer-checked:bg-sky-600 peer-checked:border-sky-600 peer-checked:text-white
                                                         cursor-pointer transition">
                                                {{ $opt }}
                                            </span>
                                        </label>
                                    @empty
                                        <p class="text-slate-500 text-sm">Belum ada opsi ISO Category.</p>
                                    @endforelse
                                </div>
                            </div>

                            {{-- Searchable: Source --}}
                            <div x-data="selectSearch({ options: @js($sources ?? []), value: @entangle('source') })" class="relative">
                                <input type="hidden" wire:model.defer="source" x-model="value">
                                <div @click="open=!open" class="rounded-xl border border-slate-300 px-3.5 py-3 cursor-pointer hover:bg-slate-50
                                                               focus-within:border-sky-500 focus-within:ring-2 focus-within:ring-sky-200">
                                    <label class="block text-xs text-slate-500 -mt-1 mb-1">Risk Source</label>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-800" x-text="value || '— pilih —'"></span>
                                        <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                                <div x-show="open" @click.outside="open=false" x-transition
                                     class="absolute z-10 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg p-2">
                                    <input type="text" x-model="q" placeholder="Cari..."
                                           class="w-full rounded-lg border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 px-3 py-2 mb-2">
                                    <div class="max-h-48 overflow-auto space-y-1">
                                        <template x-for="opt in filtered()" :key="opt">
                                            <button type="button" @click="choose(opt)" class="w-full text-left px-3 py-2 rounded-md hover:bg-sky-50">
                                                <span x-text="opt"></span>
                                            </button>
                                        </template>
                                        <p class="text-sm text-slate-400 px-3 py-2" x-show="filtered().length===0">Tidak ada hasil</p>
                                    </div>
                                </div>
                                @error('source') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Floating: Owner --}}
                            <div class="relative">
                                <input id="owner" type="text" wire:model.defer="owner"
                                       class="peer w-full rounded-xl border border-slate-300 bg-white px-3.5 py-3 placeholder-transparent
                                              focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                                       placeholder="Risk Owner">
                                <label for="owner"
                                       class="pointer-events-none absolute left-3.5 top-3.5 px-1 text-slate-500 transition-all
                                              peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-slate-400
                                              peer-focus:-top-2 peer-focus:text-xs peer-focus:text-sky-600 bg-white">
                                    Risk Owner
                                </label>
                                @error('owner') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <footer class="px-6 py-4 border-t border-slate-100 flex justify-end">
                        <button type="button" @click="step=2" class="px-4 py-2 rounded-lg bg-sky-600 text-white hover:bg-sky-700">Next</button>
                    </footer>
                </div>

                {{-- ============ STEP 2: CONTROL ============ --}}
                <div x-show="step===2" x-transition.opacity.scale.origin.top class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                    <header class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12 3l7.5 3v6c0 4.418-3.134 8.363-7.5 9-4.366-.637-7.5-4.582-7.5-9V6L12 3z"/>
                            <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                        </svg>
                        <h2 class="text-base font-semibold">Control Existing</h2>
                    </header>

                    <div class="p-6 space-y-3">
                        <p class="text-sm text-slate-500">Catat kontrol/mitigasi yang sudah berjalan.</p>
                        <textarea rows="6" wire:model.defer="control_existing"
                                  class="w-full rounded-xl border border-slate-300 px-3.5 py-3 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                                  placeholder="Contoh: SOP incident response; Monitoring; Preventive maintenance; ..."></textarea>
                        @error('control_existing') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <footer class="px-6 py-4 border-t border-slate-100 flex justify-between">
                        <button type="button" @click="step=1" class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Back</button>
                        <button type="button" @click="step=3" class="px-4 py-2 rounded-lg bg-sky-600 text-white hover:bg-sky-700">Next</button>
                    </footer>
                </div>

                {{-- ============ STEP 3: INHERENT ============ --}}
                <div x-show="step===3" x-transition.opacity.scale.origin.top class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                    <header class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12 3s-2 2-2 4a4 4 0 108 0c0-2-2-4-2-4s2 6-4 6-4-6-4-6z"/>
                            <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M8 14a4 4 0 108 0 4 4 0 11-8 0z"/>
                        </svg>
                        <h2 class="text-base font-semibold">Inherent Risk</h2>
                    </header>

                    <div class="p-6 space-y-3">
                        <p class="text-sm text-slate-500">Catatan inherent risk (sebelum kontrol).</p>
                        <textarea rows="6" wire:model.defer="inherent_note"
                                  class="w-full rounded-xl border border-slate-300 px-3.5 py-3 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                                  placeholder="Tulis konteks inherent risk di sini..."></textarea>
                        @error('inherent_note') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <footer class="px-6 py-4 border-t border-slate-100 flex justify-between">
                        <button type="button" @click="step=2" class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Back</button>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">Save Draft</button>
                    </footer>
                </div>

            </form>
        </section>
    </div>
</div>

{{-- ============== Alpine helper untuk searchable select (tanpa plugin) ============== --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('selectSearch', ({ options = [], value = '' }) => ({
            open: false,
            q: '',
            value,
            options,
            filtered() {
                if (!this.q) return this.options;
                return this.options.filter(o => (o+'').toLowerCase().includes(this.q.toLowerCase()));
            },
            choose(opt) {
                this.value = opt;
                this.open = false;
            }
        }))
    })
</script>
