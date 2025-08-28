<?php

namespace App\Livewire\Erm\RiskRegister;

use Livewire\Attributes\Validate;
use Livewire\Component;

class FormRR extends Component
{
    public string $layout = 'accordion';
    public int $step = 1;

    public bool $openGeneral  = true;
    public bool $openControl  = false;
    public bool $openInherent = false;

    public array $types = [];
    public array $taxonomies = [];
    public array $isoCategories = [];
    public array $sources = [];

    #[Validate('required|string|min:3')]
    public ?string $title = null;
    public ?string $description = null;
    public ?string $cause = null;

    #[Validate('required')]
    public ?string $type = null;
    #[Validate('required')]
    public ?string $taxonomy = null;

    public array $iso_selected = [];
    public ?string $source = null;
    public ?string $owner = null;

    public ?string $control_existing = null;
    public ?string $inherent_note = null;

   public function mount(): void
{
    $routeName = request()->route()?->getName();
    if ($routeName === 'rr.form.wizard')      $this->layout = 'wizard';
    elseif ($routeName === 'rr.form.tabs')    $this->layout = 'tabs';
    else                                      $this->layout = 'accordion';

    // TARIK dari DB (hanya yang active), urut sort
    $this->types         = \App\Models\RiskType::where('active', true)->orderBy('sort')->pluck('name')->toArray();
    $this->isoCategories = \App\Models\IsoCategory::where('active', true)->orderBy('sort')->pluck('name')->toArray();
    $this->sources       = \App\Models\RiskSource::where('active', true)->orderBy('sort')->pluck('name')->toArray();
    
    // Kalau kosong (belum diisi settings), biarkan array kosong supaya form tetap aman
    $this->taxonomies    = $this->taxonomies ?: ['People','Process','Technology','External']; // contoh sementara
}

    public function goToStep(int $n): void { $this->step = max(1, min(3, $n)); }
    public function nextStep(): void { if ($this->step < 3) $this->step++; }
    public function prevStep(): void { if ($this->step > 1) $this->step--; }

    public function toggle(string $which): void
    {
        if ($which === 'general')  $this->openGeneral  = ! $this->openGeneral;
        if ($which === 'control')  $this->openControl  = ! $this->openControl;
        if ($which === 'inherent') $this->openInherent = ! $this->openInherent;
    }

    public function resetForm(): void
    {
        $this->reset([
            'title','description','cause','type','taxonomy','iso_selected','source','owner','control_existing','inherent_note'
        ]);
        $this->step = 1;
        $this->openGeneral = true; $this->openControl = $this->openInherent = false;
        session()->flash('success', 'Form berhasil di-reset.');
    }

    public function save(): void
    {
        $this->validate();
        session()->flash('success', 'Draft risk berhasil disimpan (mock).');
    }

    public function render()
    {
        $view = match ($this->layout) {
            'wizard' => 'livewire.erm.risk-register.formrr-wizard',
            'tabs'   => 'livewire.erm.risk-register.formrr-tabs',
            default  => 'livewire.erm.risk-register.formrr-accordion',
        };
        return view($view)->title('Risk Register – FormRR');
    }
}
