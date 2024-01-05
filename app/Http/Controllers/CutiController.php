<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\karyawan;
use App\Http\Requests\StorecutiRequest;
use App\Http\Requests\UpdatecutiRequest;
use App\Http\Resources\cutiResource;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cutiData = Cuti::with('karyawan')->get();
        $transformedData = $cutiData->map(function ($cuti) {
            return [
                'id' => $cuti->id,
                'tgl_cuti' => $cuti->tgl_cuti,
                'lama_cuti' => $cuti->lama_cuti,
                'keterangan' => $cuti->keterangan,
                'nama_karyawan' => $cuti->karyawan->nama,
                'no_induk' => $cuti->karyawan->no_induk,
            ];
        });

        return response()->json(['data' => $transformedData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecutiRequest $request)
    {
        $karyawan = karyawan::findOrFail($request->id_karyawan);

        $totalCutiDiambil = $karyawan->cuti()->sum('lama_cuti');
        // dd($totalCutiDiambil);
        $sisaKuotaCuti = 12 - $totalCutiDiambil;

        if ($request->lama_cuti > $sisaKuotaCuti) {
            return response()->json([
                'message' => 'Kuota cuti tidak mencukupi.',
                'sisa_kuota_cuti' => $sisaKuotaCuti,
            ], 400);
        }

        $cuti = cuti::create([
            'tgl_cuti' => $request->tgl_cuti,
            'id_karyawan' => $request->id_karyawan,
            'lama_cuti' => $request->lama_cuti,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'message' => 'Data Berhasil Ditambahkan!',
            'data' => $cuti,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecutiRequest $request, cuti $cuti)
    {
        $cuti->update([
            'tgl_cuti' => $request->tgl_cuti,
            'lama_cuti' => $request->lama_cuti,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'message' => 'Data Berhasil Diperbarui!',
            'data' => $cuti,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cuti $cuti)
    {
        $cuti->delete();

        return response()->json([
            'message' => 'Data Berhasil Dihapus!',
            'data' => $cuti,
        ]);
    }

    public function showCreateForm()
    {
        return view('cuti');
    }

    public function showCuti()
    {
        return view('showcuti');
    }

    public function edit(cuti $cuti)
    {
        return view('editcuti', compact('cuti'));
    }
}
