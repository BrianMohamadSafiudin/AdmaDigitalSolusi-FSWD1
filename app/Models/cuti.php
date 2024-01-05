<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_cuti',
        'id_karyawan',
        'lama_cuti',
        'keterangan',
    ];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class, 'id_karyawan');
    }
}
