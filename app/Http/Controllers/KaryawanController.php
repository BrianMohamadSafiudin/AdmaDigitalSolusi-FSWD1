<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Http\Requests\StorekaryawanRequest;
use App\Http\Requests\UpdatekaryawanRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\karyawanResource;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = Karyawan::all();

        $transformedData = $karyawan->map(function ($karyawan) {
            $cuti = $karyawan->getTotalCuti();
            return [
                'id' => $karyawan->id,
                'nama' => $karyawan->nama,
                'alamat' => $karyawan->alamat,
                'tgl_lahir' => $karyawan->tgl_lahir,
                'tgl_bergabung' => $karyawan->tgl_bergabung,
                'no_induk' => $karyawan->no_induk,
                'sisa_cuti' => 12 - $cuti,
            ];
        });

        return response()->json(['data' => $transformedData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekaryawanRequest $request)
    {
        $karyawan = karyawan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'tgl_bergabung' => $request->tgl_bergabung,
            'no_induk' => $this->generateNoInduk(),
        ]);

        return response()->json([
            'message' => 'Data Berhasil Ditambahkan!',
            'data' => $karyawan,
        ], 201);
    }

    private function generateNoInduk()
    {
        return 'IP06' . sprintf('%03d', Karyawan::count() + 1);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekaryawanRequest $request, karyawan $karyawan)
    {
        // Update karyawan
        $karyawan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'tgl_bergabung' => $request->tgl_bergabung,
        ]);

        // Return success response with JSON format
        return response()->json([
            'message' => 'Data Berhasil Diperbarui!',
            'data' => $karyawan,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(karyawan $karyawan)
    {
        $karyawan->delete();

        return response()->json([
            'message' => 'Data Berhasil Dihapus!',
            'data' => $karyawan,
        ]);
    }

    public function firstThreeEmployees()
    {
        $karyawan = karyawan::orderBy('tgl_bergabung')->take(3)->get();
        return new karyawanResource($karyawan);
    }

    public function showCreateForm()
    {
        return view('karyawan');
    }

    public function showkaryawan()
    {
        return view('showkaryawan');
    }

    public function edit(karyawan $karyawan)
    {
        return view('editkaryawan', compact('karyawan'));
    }
}
