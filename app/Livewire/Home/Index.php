<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.home.index')
            ->layout('components.layouts.app') // pakai ini jika layout kamu ada di resources/views/components/layouts/app.blade.php
            // ->layout('layouts.app')         // pakai baris ini kalau layout-mu di resources/views/layouts/app.blade.php
            ->title('Home');
    }
}
