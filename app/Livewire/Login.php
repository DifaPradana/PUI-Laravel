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
            'no_hp' => ['required', 'regex:/^08[0-9]{7,}/', 'min:9', 'numeric', 'digits_between:9,15'],
            'password' => 'required|min:8'
        ], $message);


        if (Auth::attempt([
            'no_hp' => $this->no_hp,
            'password' => $this->password
        ])) {
            // session()->flash('login_success');
            // return redirect()->route('dashboard');

            $user = Auth::user();
            if ($user->id_role == 1 && $user->status == 'aktif') {
                return redirect()->route('pengelola-dashboard');
            } else {
                Auth::logout();
                $this->dispatch('sweet-alert', icon: 'error', title: 'Akun tidak aktif');
                return redirect()->back();
            }
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
        return redirect()->route('login');
    }
}
