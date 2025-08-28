<?php

namespace App\Livewire\Risks;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.risks.index')
            ->layout('components.layouts.erm')   
            ->title('Risk Register');
    }
}
