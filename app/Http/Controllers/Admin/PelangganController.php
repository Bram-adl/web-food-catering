<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePelanggan;
use App\Http\Requests\UpdatePelanggan;
use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::latest()->get();
        $kota = DB::table('kota')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();

        return view('admin.pelanggan.index', [
            'pelanggan' => $pelanggan,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelanggan $request)
    {
        $validated = $request->validated();
        
        Pelanggan::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'wa' => $validated['wa'],
            'rumah_teks' => $validated['rumah_teks'],
            'rumah_maps' => $validated['rumah_maps'],
            'rumah_kota' => $validated['rumah_kota'],
            'rumah_kecamatan' => $validated['rumah_kecamatan'],
            'rumah_kelurahan' => $validated['rumah_kelurahan'],
            'kantor_teks' => $validated['kantor_teks'],
            'kantor_maps' => $validated['kantor_maps'],
            'kantor_kota' => $validated['kantor_kota'],
            'kantor_kecamatan' => $validated['kantor_kecamatan'],
            'kantor_kelurahan' => $validated['kantor_kelurahan'],
            'keterangan' => $validated['keterangan'],
        ]);
        
        return redirect()
                ->route('pelanggan.index')
                ->with('status', 'Pelanggan berhasil disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        $kota = DB::table('kota')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();
        
        return view('admin.pelanggan.edit', [
            'pelanggan' => $pelanggan,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelanggan $request, $id)
    {
        $validated = $request->validated();
        $pelanggan = Pelanggan::find($id);
        
        // if password is changed
        if ($validated['password']) {
            $pelanggan->password = Hash::make($validated['password']);
        }

        $pelanggan->nama = $validated['nama'];
        $pelanggan->email = $validated['email'];
        $pelanggan->rumah_teks = $validated['rumah_teks'];
        $pelanggan->rumah_maps = $validated['rumah_maps'];
        $pelanggan->rumah_kota = $validated['rumah_kota'];
        $pelanggan->rumah_kecamatan = $validated['rumah_kecamatan'];
        $pelanggan->rumah_kelurahan = $validated['rumah_kelurahan'];
        $pelanggan->kantor_teks = $validated['kantor_teks'];
        $pelanggan->kantor_maps = $validated['kantor_maps'];
        $pelanggan->kantor_kota = $validated['kantor_kota'];
        $pelanggan->kantor_kecamatan = $validated['kantor_kecamatan'];
        $pelanggan->kantor_kelurahan = $validated['kantor_kelurahan'];
        $pelanggan->keterangan = $validated['keterangan'];

        $pelanggan->save();

        return redirect()
                ->route('pelanggan.index')
                ->with('status', 'Pelanggan berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus ' . $pelanggan->nama . '!',
        ]);
    }
}
