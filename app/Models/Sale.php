<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_penjualan',
        'customer_id',
        'jumlah_barang',
        'total_harga',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
