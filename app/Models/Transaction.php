<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    protected $fillable = [
        'kode_transaksi',
        'kode_kue',
        'nama_pembeli',
        'nomor_telepon',
        'alamat',
        'catatan',
        'jumlah_kue',
        'total_harga',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'kode_kue', 'kode_kue');
    }
}
