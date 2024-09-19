<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AkunManager extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    public $searchRole = '';


    public $no_hp;
    public $password;
    public $username;
    public $role;
    public $editUserId;


    #[Computed()]
    public function getRoles()
    {
        return Role::all();
    }


    public function daftarin()
    {
        $message = [
            'no_hp.required' => 'Nomor HP tidak boleh kosong',
            'no_hp.regex' => 'Nomor HP harus Valid',
            'no_hp.min' => 'Nomor HP minimal 9 karakter',
            'no_hp.unique' => 'Nomor HP sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Username minimal 5 karakter',
            'role.required' => 'Role tidak boleh kosong'
        ];

        $this->validate([
            'no_hp' => ['required', 'regex:/^08[0-9]{7,}/', 'unique:users', 'min:9', 'numeric', 'digits_between:9,15'],
            'password' => 'required|min:8',
            'username' => 'required|min:3',
            'role' => 'required'
        ], $message);

        // dd($this->all());

        User::create([
            'no_hp' => $this->no_hp,
            'password' => bcrypt($this->password),
            'username' => $this->username,
            'id_role' => $this->role,
        ]);
        // dd($this->all());

        $this->reset();

        // dd('Setelah Reset', $this->all());

        $this->dispatch('sweet-alert', icon: 'success', title: 'Kamu berhasil mendaftarkan akun baru');
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    protected $listeners = ['delete'];

    public function delete(User $user)
    {
        $user->delete();
        $this->dispatch('sweet-alert', icon: 'success', title: 'Akun berhasil dihapus');
    }

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->editUserId = $user->id_user;
        $this->username = $user->username;
        $this->no_hp = $user->no_hp;
        $this->role = $user->id_role;
    }

    public function updateUser()
    {
        $this->validate([
            'role' => 'required|exists:roles,id_role',
        ]);

        $user = User::findOrFail($this->editUserId); // Temukan user yang diedit
        $user->id_role = $this->role; // Update role user
        $user->save();

        // Reset field dan tampilkan pesan sukses
        $this->reset(['editUserId', 'role']);
        $this->dispatch('sweet-alert', icon: 'success', title: 'Role user berhasil diperbarui!');
    }

    #[Layout('components.layouts.pengelola_master')]
    public function render()
    {
        return view('livewire.akun-manager', [
            'users' => User::select('id_user', 'username', 'no_hp', 'id_role', 'status', 'created_at', 'updated_at')->search($this->search)->when($this->searchRole, function ($query) {
                $query->where('id_role', $this->searchRole);
            })->paginate($this->perPage),
        ]);
    }
}
