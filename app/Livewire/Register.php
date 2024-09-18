<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;

use Livewire\Component;

class Register extends Component
{
    #[Layout('components.layouts.auth')]

    public $no_hp;
    public $password;
    public $username;

    public function render()
    {
        return view('livewire.register');
    }

    public function register()
    {

        $message = [
            'no_hp.required' => 'Nomor HP tidak boleh kosong',
            'no_hp.regex' => 'Nomor HP harus Valid',
            'no_hp.min' => 'Nomor HP minimal 9 karakter',
            'no_hp.unique' => 'Nomor HP sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Username minimal 5 karakter'
        ];

        $this->validate([
            'no_hp' => ['required', 'regex:/^08[0-9]{7,}/', 'unique:users'],
            'password' => 'required|min:8',
            'username' => 'required|min:3'
        ], $message);

        // dd($this->all());

        User::create([
            'no_hp' => $this->no_hp,
            'password' => bcrypt($this->password),
            'username' => $this->username,
            'id_role' => 4,
        ]);

        $this->dispatch('sweet-alert', icon: 'success', title: 'Register berhasil, silahkan login');

        return redirect()->route('login');
    }
}
