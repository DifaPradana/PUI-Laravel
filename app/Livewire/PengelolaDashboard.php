<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class PengelolaDashboard extends Component
{
    public function mount()
    {
        // if (session()->has('login_success')) {
        //     $this->dispatch('sweet-alert', icon: 'success', title: 'Selamat datang');
        // }
    }

    #[Layout('components.layouts.pengelola_master')]
    public function render()
    {
        return view('livewire.pengelola-dashboard');
    }

    // #[On('sweet-alert')]
}
