<?php

namespace App\Http\Resources;

use App\Models\cuti;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class cutiResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tgl_cuti' => $this->tgl_cuti,
            'lama_cuti' => $this->lama_cuti,
            'keterangan' => $this->keterangan,
            'nama_karyawan' => $this->karyawan->nama,
            'no_induk' => $this->karyawan->no_induk,
        ];
    }
}
