<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanans';
    protected $primaryKey = 'id_layanan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_layanan',
        'biaya',
    ];


    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'layanan', 'id_layanan');
    }
}
