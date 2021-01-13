<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengantaran;
use App\Http\Requests\UpdatePelanggan;
use App\Pelanggan;
use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Return the profile page.
     * 
     * @return view
     */
    public function profile($nama)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }
        
        return view('client.profile.index', [
            'user' => Auth::user(),
            'kota' => DB::table('kota')->get(),
            'kecamatan' => DB::table('kecamatan')->get(),
            'kelurahan' => DB::table('kelurahan')->get(),
        ]);
    }

    /**
     * Return the pembelian page for the given user
     * 
     * @param String $nama
     * @return view
     */
    public function profilePembelian($nama)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }
        
        $pembelian = Pembelian::where([
            'id_pelanggan' => Auth::user()->id,
        ])->get();
        
        $paket = [];
        foreach ($pembelian as $p) {
            $paket[] = $p->paket;
        }
        
        return view('client.profile.pembelian', [
            'user' => Auth::user(),
            'pembelian' => $pembelian,
            'paket' => $paket,
        ]);
    }

    /**
     * Update the specified profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelanggan $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        // wether the user changes their password.
        if (strlen($request->password)) {
            $pelanggan->password = Hash::make($request->password);
        }

        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->wa = $request->wa;
        $pelanggan->rumah_teks = $request->rumah_teks;
        $pelanggan->rumah_maps = $request->rumah_maps;
        $pelanggan->rumah_kota = $request->rumah_kota;
        $pelanggan->rumah_kecamatan = $request->rumah_kecamatan;
        $pelanggan->rumah_kelurahan = $request->rumah_kelurahan;
        $pelanggan->kantor_teks = $request->kantor_teks;
        $pelanggan->kantor_maps = $request->kantor_maps;
        $pelanggan->kantor_kota = $request->kantor_kota;
        $pelanggan->kantor_kecamatan = $request->kantor_kecamatan;
        $pelanggan->kantor_kelurahan = $request->kantor_kelurahan;
        $pelanggan->keterangan = $request->keterangan;

        $updated = $pelanggan->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Data updated successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'An error occured unexpectedly.',
            ]);
        }
    }

    /**
     * Store the newly created request pengantaran
     * 
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function storePengantaran(StorePengantaran $request, $id)
    {
        // simpan pengantaran
    }
}
