<?php

namespace App\Livewire\Erm;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.erm.dashboard')
            ->layout('components.layouts.erm')   // pakai header layout
            ->title('ERM Dashboard');
    }
}
