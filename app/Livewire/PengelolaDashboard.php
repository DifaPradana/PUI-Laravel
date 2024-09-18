<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PengelolaDashboard extends Component
{
    #[Layout('components.layouts.pengelola_master')]
    public function render()
    {
        return view('livewire.pengelola-dashboard');
    }
}
