<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengantaran;
use App\Http\Requests\UpdatePelanggan;
use App\Pelanggan;
use App\Pembelian;
use App\Pesanan;
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

    public function profilePengantaran($id)
    {
        $pengantaran = DB::table('pengantaran AS pg')
                            ->join('pesanan AS ps', 'ps.id', 'pg.id_pesanan')
                            ->join('pembelian AS pb', 'pb.id', 'ps.id_pembelian')
                            ->join('pelanggan AS pl', 'pl.id', 'pb.id_pelanggan')
                            ->join('paket AS pk', 'pk.id', 'pb.id_paket')
                            ->select(
                                'pg.id', 'ps.tanggal_kirim', 'ps.waktu_kirim',
                                'ps.porsi', 'ps.lokasi', 'pg.status',
                                'ps.catatan_pelanggan', 'pg.catatan_kurir', 
                            )
                            ->where([
                                ['pl.id', Auth::user()->id],
                            ])
                            ->get();

        return $pengantaran;
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
                                ])
                                ->get();
        
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
        $validated = $request->validated();
        
        // simpan pengantaran
        Pesanan::create([
            'id_pembelian' => $validated['id_pembelian'],
            'tanggal_kirim' => $validated['tanggal_kirim'],
            'waktu_kirim' => $validated['waktu_kirim'],
            'alamat' => $validated['alamat'],
            'porsi' => $validated['porsi'],
            'catatan_pelanggan' => $validated['catatan_pelanggan'] ? $validated['catatan_pelanggan'] : '-',
            'catatan_kurir' => '-',
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat request!',
        ]);
    }
}
