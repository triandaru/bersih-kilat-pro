<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_user',
        'username',
        'password',
        'akses',
    ];

    public function akses()
    {
        return $this->belongsTo(HakAkses::class, 'id_akses');
    }
}
