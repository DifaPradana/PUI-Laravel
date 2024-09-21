<?php

namespace App\Livewire;

use App\Models\KategoriMenu;
use App\Models\Menu;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class MenuManager extends Component
{

    use WithFileUploads;
    public $perPage = 10;
    public $search = '';
    public $searchRole = '';

    public $id_menu;
    public $nama_menu;
    public $harga;
    public $deskripsi;
    public $kategori_menu;
    public $status;
    public $gambar;
    public $gambarLama;

    public $editMenuID;


    #[Computed()]
    public function getKategoriMenus()
    {
        return KategoriMenu::all();
    }

    public function tambahMenu()
    {
        $message = [
            'nama_menu.required' => 'Nama Menu tidak boleh kosong',
            'harga.required' => 'Harga tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'kategori_menu.required' => 'Kategori Menu tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'gambar.required' => 'Gambar tidak boleh kosong',
            'gambar.mimes' => 'Gambar harus berformat jpg, jpeg, atau png',
            'gambar.max' => 'Gambar tidak boleh lebih dari 2MB'
        ];

        $this->validate([
            'nama_menu' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'kategori_menu' => 'required',
            'status' => 'required',
            'gambar' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ], $message);

        // dd($this->all());

        if (!file_exists(storage_path('app/public/gambar/menu'))) {
            mkdir(storage_path('app/public/gambar/menu'), 0777, true);
        }

        $namaGambar =   $this->nama_menu . '_Image' . '.' . $this->gambar->getClientOriginalExtension();
        $this->gambar->storeAs('public/gambar/menu', $namaGambar, ['overwrite' => true]);

        // dd($namaGambar);

        Menu::create([
            'nama_menu' => $this->nama_menu,
            'harga' => $this->harga,
            'deskripsi' => $this->deskripsi,
            'id_kategori_menu' => $this->kategori_menu,
            'status' => $this->status,
            'gambar' => $namaGambar
        ]);

        $this->reset();
        $this->dispatch('sweet-alert', icon: 'success', title: 'Kamu berhasil menambahkan menu baru');
    }

    public function menuEdit(int $id_menu)
    {
        $menu = Menu::find($id_menu);
        if ($menu) {
            $this->id_menu = $menu->id_menu;
            $this->nama_menu = $menu->nama_menu;
            $this->harga = $menu->harga;
            $this->deskripsi = $menu->deskripsi;
            $this->kategori_menu = $menu->id_kategori_menu;
            $this->status = $menu->status;
            $this->gambarLama = $menu->gambar;
            $this->gambar = null;
        }
        // dd($menu);
    }

    public function closeModal()
    {
        $this->reset();
    }

    public function menuUpdate()
    {
        $message = [
            'nama_menu.required' => 'Nama Menu tidak boleh kosong',
            'harga.required' => 'Harga tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'kategori_menu.required' => 'Kategori Menu tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'gambar.mimes' => 'Gambar harus berformat jpg, jpeg, atau png',
            'gambar.max' => 'Gambar tidak boleh lebih dari 2MB'
        ];

        $this->validate([
            'nama_menu' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'kategori_menu' => 'required',
            'status' => 'required',
            'gambar' => 'file|mimes:jpg,jpeg,png|max:2048',
        ], $message);


        $menu = Menu::find($this->id_menu);
        if ($menu) {
            $namaGambar = $menu->gambar;
            if ($this->gambar) {
                if (!file_exists(storage_path('app/public/gambar/menu'))) {
                    mkdir(storage_path('app/public/gambar/menu'), 0777, true);
                }

                // Delete existing image with different extension
                $existingExtensions = ['jpg', 'jpeg', 'png'];
                foreach ($existingExtensions as $extension) {
                    $existingFilePath = storage_path('app/public/gambar/menu/' . $this->nama_menu . '_Image.' . $extension);
                    if (file_exists($existingFilePath)) {
                        unlink($existingFilePath);
                    }
                }

                // Store the new image
                $namaGambar = $this->nama_menu . '_Image' . '.' . $this->gambar->getClientOriginalExtension();
                $this->gambar->storeAs('public/gambar/menu', $namaGambar, ['overwrite' => true]);
            }

            $menu->update([
                'nama_menu' => $this->nama_menu,
                'harga' => $this->harga,
                'deskripsi' => $this->deskripsi,
                'id_kategori_menu' => $this->kategori_menu,
                'status' => $this->status,
                'gambar' => $namaGambar
            ]);
        }

        $this->dispatch('sweet-alert', icon: 'success', title: 'Kamu berhasil mengubah menu');
    }


    #[Layout('components.layouts.pengelola_master')]
    public function render()
    {
        return view('livewire.menu-manager', [
            'menus' => Menu::paginate($this->perPage)
        ]);
    }
}
