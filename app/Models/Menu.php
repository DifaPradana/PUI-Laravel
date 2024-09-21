<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'gambar',
        'harga',
        'status',
        'id_kategori_menu',
    ];

    public function kategoriMenu()
    {
        return $this->belongsTo(KategoriMenu::class, 'id_kategori_menu', 'id_kategori_menu');
    }
}
