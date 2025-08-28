  <div class="max-w-6xl mx-auto p-4 sm:p-6">
    <h1 class="text-2xl font-semibold mb-4">Risk Register (MVP)</h1>

    {{-- Form Tambah Risk --}}
    <div class="border border-gray-200 rounded-xl p-4 sm:p-5 mb-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Risk Event <span class="text-red-500">*</span></label>
          <input type="text" wire:model.defer="title" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
          @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Owner</label>
          <input type="text" wire:model.defer="owner" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
          @error('owner') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
          <textarea rows="2" wire:model.defer="description" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"></textarea>
          @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1">Cause</label>
          <textarea rows="2" wire:model.defer="cause" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"></textarea>
          @error('cause') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Likelihood (1–5)</label>
          <select wire:model.live="likelihood" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
            @for ($i=1;$i<=5;$i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
          @error('likelihood') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Impact (1–5)</label>
          <select wire:model.live="impact" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
            @for ($i=1;$i<=5;$i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
          @error('impact') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      {{-- Preview skor --}}
      <div class="mt-3 text-sm">
        <span class="font-medium">Inherent Score:</span>
        <span class="px-2 py-1 rounded bg-gray-100">{{ max(1, min(5, $this->$likelihood)) * max(1, min(5, $this->$impact)) }}</span>
      </div>

      <div class="mt-4">
        <button type="button" wire:click="save"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">
          Save Risk
        </button>
      </div>

      {{-- Tampilkan error validasi umum, jika ada --}}
      @if ($errors->any())
        <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
          @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      @endif
    </div>

    {{-- Tabel Risks + Inline Edit --}}
    <div class="mt-6 overflow-x-auto">
      <table class="min-w-full border border-gray-200 rounded-xl overflow-hidden">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="px-4 py-2 text-left">Title</th>
            <th class="px-4 py-2 text-left">Owner</th>
            <th class="px-4 py-2 text-center">L</th>
            <th class="px-4 py-2 text-center">I</th>
            <th class="px-4 py-2 text-center">Score</th>
            <th class="px-4 py-2 text-center">Level</th>
            <th class="px-4 py-2 text-center">Status</th>
            <th class="px-4 py-2 text-center">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($items as $r)
            <tr>
              @if($editId === $r->id)
                {{-- Mode Edit --}}
                <td class="px-4 py-2">
                  <input type="text" wire:model="editTitle" class="w-full border rounded px-2 py-1 focus:outline-none focus:ring focus:ring-blue-200">
                </td>
                <td class="px-4 py-2">
                  <input type="text" wire:model="editOwner" class="w-full border rounded px-2 py-1 focus:outline-none focus:ring focus:ring-blue-200">
                </td>
                <td class="px-4 py-2 text-center">
                  <input type="number" min="1" max="5" wire:model="editLikelihood" class="w-20 text-center border rounded px-2 py-1 focus:outline-none focus:ring focus:ring-blue-200">
                </td>
                <td class="px-4 py-2 text-center">
                  <input type="number" min="1" max="5" wire:model="editImpact" class="w-20 text-center border rounded px-2 py-1 focus:outline-none focus:ring focus:ring-blue-200">
                </td>
                <td class="px-4 py-2 text-center">{{ $editLikelihood * $editImpact }}</td>
                <td class="px-4 py-2 text-center">
                  {{ ($editLikelihood * $editImpact) >= 15 ? 'High' :
                     (($editLikelihood * $editImpact) >= 6 ? 'Medium' : 'Low') }}
                </td>
                <td class="px-4 py-2 text-center">{{ $r->status }}</td>
                <td class="px-4 py-2 text-center space-x-2">
                  <button wire:click="update({{ $r->id }})" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
                  <button wire:click="cancelEdit" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
                </td>
              @else
                {{-- Mode Normal --}}
                <td class="px-4 py-2 font-medium">{{ $r->title }}</td>
                <td class="px-4 py-2">{{ $r->owner ?: '—' }}</td>
                <td class="px-4 py-2 text-center">{{ $r->likelihood }}</td>
                <td class="px-4 py-2 text-center">{{ $r->impact }}</td>
                <td class="px-4 py-2 text-center">{{ $r->inherent_score }}</td>
                <td class="px-4 py-2 text-center">{{ $r->level }}</td>
                <td class="px-4 py-2 text-center">
                  <span class="px-2 py-1 rounded text-white {{ $r->status === 'Open' ? 'bg-blue-600' : 'bg-gray-600' }}">
                    {{ $r->status }}
                  </span>
                </td>
                <td class="px-4 py-2 text-center space-x-2">
                  <button wire:click="edit({{ $r->id }})" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                  <button wire:click="toggleStatus({{ $r->id }})" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                    {{ $r->status === 'Open' ? 'Close' : 'Reopen' }}
                  </button>
                  <button wire:click="delete({{ $r->id }})" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </td>
              @endif
            </tr>
          @empty
            <tr>
              <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada data.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>