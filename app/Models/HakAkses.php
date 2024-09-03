<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;

    protected $table = 'hak_akses';
    protected $primaryKey = 'id_akses';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_akses',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_akses');
    }
}
