<div class="max-w-6xl mx-auto px-6 py-10">
    <h1 class="text-2xl font-semibold mb-6">Create Risk Register</h1>

    @if (session('ok'))
        <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">
            {{ session('ok') }}
        </div>
    @endif

    {{-- Penting: kirim variabel ke partial form --}}
    @include('livewire.erm.risk-register.form', [
        'types'         => $types,
        'taxonomies'    => $taxonomies,
        'isoCategories' => $isoCategories,
    ])
</div>
