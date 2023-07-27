<?php

namespace App\Models;

use App\Models\PesananDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
		'keterangan',
        'kategori',
		'gambar'
    ];

    public function pesanan_detail() 
	{
	     return $this->hasMany(PesananDetail::class,'product_id', 'id');
	}
}
