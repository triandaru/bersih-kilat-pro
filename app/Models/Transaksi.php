<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tanggal',
        'nama_pelanggan',
        'no_kendaraan',
        'layanan',
        'total_biaya',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan', 'id_layanan');
    }

    protected $dates = ['tanggal'];

    // Mutator untuk mengatur format tanggal
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
    }
}
