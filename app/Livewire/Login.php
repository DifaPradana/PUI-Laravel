<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{

    public $no_hp;
    public $password;

    #[Layout('components.layouts.auth')]

    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
        $message = [
            'no_hp.required' => 'Nomor HP tidak boleh kosong',
            'no_hp.min' => 'Nomor HP minimal 9 karakter',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter'
        ];
        $this->validate([
            'no_hp' => 'required|numeric|min:9',
            'password' => 'required|min:8'
        ], $message);


        if (Auth::attempt([
            'no_hp' => $this->no_hp,
            'password' => $this->password
        ])) {
            return redirect()->route('dashboard');
        } else {
            $this->dispatch('sweet-alert', icon: 'error', title: 'Nomor HP atau Password salah');
            return redirect()->back();
        }

        // dd($this->all());

        $this->dispatch('sweet-alert', icon: 'success', title: 'Register berhasil, silahkan login');
    }

    public function logout()
    {
        Auth::logout();
        $this->dispatch('sweet-alert', icon: 'success', title: 'Register Logout');
        return redirect()->route('login');
    }
}
