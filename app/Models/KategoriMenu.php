<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMenu extends Model
{
    use HasFactory;

    protected $table = 'kategori_menus';

    protected $primaryKey = 'id_kategori_menu';

    protected $fillable = [
        'nama_kategori_menu',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_kategori_menu', 'id_kategori_menu');
    }
}
