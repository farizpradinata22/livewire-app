<?php

namespace App\Livewire\Erm\RiskRegister;

use Livewire\Component;

class Create extends Component
{
    /** -------------------------
     *  OPSI DROPDOWN (sementara hardcoded; nanti bisa tarik dari DB)
     *  ------------------------- */
    public array $types = [];
    public array $taxonomies = [];
    public array $isoCategories = [];

    /** -------------------------
     *  FIELD FORM (contoh)
     *  ------------------------- */
    public ?string $type = null;
    public ?string $taxonomy = null;
    public array $iso_selected = [];
    public ?string $title = null;
    public ?string $description = null;

    public function mount(): void
    {
        // TODO: ganti dengan query DB sesuai skema master kamu
        $this->types         = ['Operational', 'Strategic', 'Compliance', 'Financial'];
        $this->taxonomies    = ['People', 'Process', 'Technology', 'External'];
        $this->isoCategories = ['ISO 9001', 'ISO 14001', 'ISO 27001', 'ISO 45001', 'ISO 22301'];
    }

    public function save(): void
    {
        // Validasi sederhana contoh (opsional)
        $this->validate([
            'title'        => 'required|string|min:3',
            'type'         => 'required|string',
            'taxonomy'     => 'required|string',
            'iso_selected' => 'array|min:1',
        ], [], [
            'title'        => 'Judul',
            'type'         => 'Risk Type',
            'taxonomy'     => 'Risk Taxonomy',
            'iso_selected' => 'ISO Category',
        ]);

        // TODO: simpan ke DB sesuai tabel risk_register kamu
        // Contoh mock:
        // Risk::create([...]);

        session()->flash('ok', 'Risk berhasil disimpan (mock).');
        // Reset sebagian field agar terlihat efeknya
        $this->title = $this->description = null;
        $this->type = $this->taxonomy = null;
        $this->iso_selected = [];
    }

    public function render()
    {
        // View utama (akan include partial form & kirim variabel opsinya)
        return view('livewire.erm.risk-register.create')
            ->title('Create Risk Register');
    }
}
