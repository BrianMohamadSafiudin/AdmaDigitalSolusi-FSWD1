<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'tgl_lahir',
        'tgl_bergabung',
        'no_induk',
    ];

    public function cuti()
    {
        return $this->hasMany(cuti::class, 'id_karyawan');
    }

    public function getTotalCuti()
    {
        return $this->cuti()->sum('lama_cuti');
    }
}
