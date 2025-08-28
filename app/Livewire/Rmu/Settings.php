<?php

namespace App\Livewire\Rmu;

use App\Models\IsoCategory;
use App\Models\RiskSource;
use App\Models\RiskType;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Settings extends Component
{
    // Tabs
    public string $tab = 'type'; // type|iso|source

    // Input fields
    #[Validate('required|string|min:2|unique:risk_types,name')]
    public string $type_name = '';
    #[Validate('required|string|min:2|unique:iso_categories,name')]
    public string $iso_name = '';
    #[Validate('required|string|min:2|unique:risk_sources,name')]
    public string $source_name = '';

    public function addType(): void
    {
        $this->validateOnly('type_name');
        $maxSort = (int) RiskType::max('sort');
        RiskType::create(['name'=>$this->type_name, 'sort'=>$maxSort+1, 'active'=>true]);
        $this->reset('type_name');
        session()->flash('ok','Risk Type ditambahkan.');
    }

    public function addIso(): void
    {
        $this->validateOnly('iso_name');
        $maxSort = (int) IsoCategory::max('sort');
        IsoCategory::create(['name'=>$this->iso_name, 'sort'=>$maxSort+1, 'active'=>true]);
        $this->reset('iso_name');
        session()->flash('ok','ISO Category ditambahkan.');
    }

    public function addSource(): void
    {
        $this->validateOnly('source_name');
        $maxSort = (int) RiskSource::max('sort');
        RiskSource::create(['name'=>$this->source_name, 'sort'=>$maxSort+1, 'active'=>true]);
        $this->reset('source_name');
        session()->flash('ok','Risk Source ditambahkan.');
    }

    public function toggle(string $model, int $id): void
    {
        $class = [
            'type'   => RiskType::class,
            'iso'    => IsoCategory::class,
            'source' => RiskSource::class,
        ][$model] ?? null;

        if (!$class) return;

        $row = $class::findOrFail($id);
        $row->active = ! $row->active;
        $row->save();
    }

    public function delete(string $model, int $id): void
    {
        $class = [
            'type'   => RiskType::class,
            'iso'    => IsoCategory::class,
            'source' => RiskSource::class,
        ][$model] ?? null;

        if (!$class) return;

        $class::whereKey($id)->delete();
    }

    public function render()
    {
        return view('livewire.rmu.settings', [
            'types'   => RiskType::orderBy('sort')->get(),
            'isos'    => IsoCategory::orderBy('sort')->get(),
            'sources' => RiskSource::orderBy('sort')->get(),
        ])->title('RMU Settings');
    }
}
