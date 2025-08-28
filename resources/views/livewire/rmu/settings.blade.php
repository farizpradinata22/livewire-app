<div class="max-w-6xl mx-auto px-4 lg:px-6 py-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold">RMU Settings</h1>
            <p class="text-xs text-slate-500">Kelola master: Risk Type, ISO Category, Risk Source</p>
        </div>
        <a href="{{ url('/erm/risk-register/form/wizard') }}"
           class="px-3.5 py-2 rounded-lg border border-slate-300 hover:bg-slate-50 text-slate-700">
            ← Kembali ke Form RR
        </a>
    </div>

    @if (session('ok'))
        <div class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700">
            {{ session('ok') }}
        </div>
    @endif

    {{-- Tabs --}}
    <div class="border-b border-slate-200 mb-4">
        <nav class="-mb-px flex gap-6">
            <button type="button" wire:click="$set('tab','type')"   class="py-2 border-b-2 {{ $tab==='type'?'border-sky-600 text-sky-700':'border-transparent text-slate-500 hover:text-slate-700' }}">Risk Type</button>
            <button type="button" wire:click="$set('tab','iso')"    class="py-2 border-b-2 {{ $tab==='iso'?'border-sky-600 text-sky-700':'border-transparent text-slate-500 hover:text-slate-700' }}">ISO Category</button>
            <button type="button" wire:click="$set('tab','source')" class="py-2 border-b-2 {{ $tab==='source'?'border-sky-600 text-sky-700':'border-transparent text-slate-500 hover:text-slate-700' }}">Risk Source</button>
        </nav>
    </div>

    {{-- Panel --}}
    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
        <div class="p-6">
            @if ($tab==='type')
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tambah Risk Type</label>
                        <form wire:submit.prevent="addType" class="flex gap-2">
                            <input type="text" wire:model.defer="type_name" class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200" placeholder="mis. Operational">
                            <button class="px-3.5 py-2 rounded-lg bg-sky-600 text-white hover:bg-sky-700">Tambah</button>
                        </form>
                        @error('type_name') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-slate-500">
                                    <th class="text-left py-2">Nama</th>
                                    <th class="text-left py-2">Active</th>
                                    <th class="text-right py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $row)
                                    <tr class="border-t">
                                        <td class="py-2">{{ $row->name }}</td>
                                        <td class="py-2">
                                            <button wire:click="toggle('type', {{ $row->id }})"
                                                    class="px-2 py-1 rounded {{ $row->active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $row->active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td>
                                        <td class="py-2 text-right">
                                            <button wire:click="delete('type', {{ $row->id }})" class="px-2 py-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @elseif ($tab==='iso')
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tambah ISO Category</label>
                        <form wire:submit.prevent="addIso" class="flex gap-2">
                            <input type="text" wire:model.defer="iso_name" class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200" placeholder="mis. ISO 27001">
                            <button class="px-3.5 py-2 rounded-lg bg-sky-600 text-white hover:bg-sky-700">Tambah</button>
                        </form>
                        @error('iso_name') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-slate-500">
                                    <th class="text-left py-2">Nama</th>
                                    <th class="text-left py-2">Active</th>
                                    <th class="text-right py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($isos as $row)
                                    <tr class="border-t">
                                        <td class="py-2">{{ $row->name }}</td>
                                        <td class="py-2">
                                            <button wire:click="toggle('iso', {{ $row->id }})"
                                                    class="px-2 py-1 rounded {{ $row->active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $row->active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td>
                                        <td class="py-2 text-right">
                                            <button wire:click="delete('iso', {{ $row->id }})" class="px-2 py-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @else
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tambah Risk Source</label>
                        <form wire:submit.prevent="addSource" class="flex gap-2">
                            <input type="text" wire:model.defer="source_name" class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200" placeholder="mis. Internal">
                            <button class="px-3.5 py-2 rounded-lg bg-sky-600 text-white hover:bg-sky-700">Tambah</button>
                        </form>
                        @error('source_name') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-slate-500">
                                    <th class="text-left py-2">Nama</th>
                                    <th class="text-left py-2">Active</th>
                                    <th class="text-right py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sources as $row)
                                    <tr class="border-t">
                                        <td class="py-2">{{ $row->name }}</td>
                                        <td class="py-2">
                                            <button wire:click="toggle('source', {{ $row->id }})"
                                                    class="px-2 py-1 rounded {{ $row->active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $row->active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td>
                                        <td class="py-2 text-right">
                                            <button wire:click="delete('source', {{ $row->id }})" class="px-2 py-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
