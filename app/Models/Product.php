<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_kue';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_kue',
        'nama_kue',
        'deskripsi',
        'harga_kue',
        'gambar_kue',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->kode_kue = self::generateKodeKue();
        });
    }

    public static function generateKodeKue()
    {
        $latest = self::orderBy('kode_kue', 'desc')->first();
        $latestKodeKue = $latest ? $latest->kode_kue : 'KUE-00000';
        $latestId = intval(substr($latestKodeKue, 4));
        return 'KUE-' . str_pad($latestId + 1, 5, '0', STR_PAD_LEFT);
    }

    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga_kue, 2, ',', '.');
    }
}