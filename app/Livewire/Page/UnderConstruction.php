<?php

namespace App\Livewire\Page;

use Livewire\Component;

class UnderConstruction extends Component
{
    public string $page = 'Page';
    public function mount(string $page = 'Page')
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.page.under-construction')
            ->layout('components.layouts.app')
            ->title($this->page.' - Under Construction');
    }
}
