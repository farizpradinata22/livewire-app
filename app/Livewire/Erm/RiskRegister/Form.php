<?php

namespace App\Livewire\Erm\RiskRegister;

use Livewire\Component;
use App\Models\RiskType;
use App\Models\RiskTaxonomy;
use App\Models\IsoCategory;

class Form extends Component
{
    // Card 1 – General Information
    public string $title = '';
    public string $description = '';
    public $type = '';
    public $taxonomy = '';
    public string $source = '';
    public string $cause = '';
    public string $owner = '';
    public $iso_category = '';

    // Card 2 – Control Existing (draft text)
    public string $control_existing = '';

    // Card 3 – Inherent Risk (draft text)
    public string $inherent_note = '';

    /** Dropdown options (sementara/seed) */

    public array $sources = [
        'Internal', 'External', 'Third-Party', 'Regulatory'
    ];

   public function mount(): void
    {
        // load dari DB yang dikelola lewat /rmu/settings
        $this->types = RiskType::where('is_active', true)->orderBy('name')->pluck('name')->toArray();
        $this->taxonomies = RiskTaxonomy::where('is_active', true)->orderBy('name')->pluck('name')->toArray();
        $this->isoCategories = IsoCategory::where('is_active', true)->orderBy('name')->pluck('name')->toArray();
    }

    protected array $rules = [
        'title'       => 'required|min:3',
        'description' => 'nullable|string',
        'type'        => 'nullable|string',
        'taxonomy'    => 'nullable|string',
        'source'      => 'nullable|string',
        'cause'       => 'nullable|string',
        'owner'       => 'nullable|string',
        'iso_category'=> 'nullable|string',
        'control_existing' => 'nullable|string',
        'inherent_note'    => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        // TODO: simpan ke DB nanti (Risk::create([...]))
        // Untuk sekarang, kita simpan sebagai “draft” di memori & tampilkan notifikasi.
        session()->flash('success', 'Draft risk tersimpan (belum ke database).');
    }

    public function resetForm()
    {
        $this->reset([
            'title','description','type','taxonomy','source','cause','owner','iso_category',
            'control_existing','inherent_note'
        ]);
    }

    public function render()
    {
        return view('livewire.erm.risk-register.form')
            ->layout('components.layouts.erm')
            ->title('Risk Register');
    }
}
