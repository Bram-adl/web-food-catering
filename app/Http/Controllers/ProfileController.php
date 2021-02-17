<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengantaran;
use App\Http\Requests\UpdatePelanggan;
use App\Http\Requests\UpdatePengantaran;
use App\Pelanggan;
use App\Pembelian;
use App\Pengantaran;
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
                                ['pg.waktu_hapus', null]
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

    public function getPengantaran($id)
    {
        $data = DB::table('pengantaran')
                    ->join('pesanan', 'pesanan.id', '=', 'pengantaran.id_pesanan')
                    ->join('pembelian', 'pembelian.id', 'pesanan.id_pembelian')
                    ->select(
                        'pengantaran.catatan_pelanggan', 'pesanan.tanggal_kirim', 'pesanan.waktu_kirim',
                        'pesanan.lokasi', 'pesanan.porsi', 'pembelian.waktu_pengiriman', 'pembelian.alamat',
                    )
                    ->where('pengantaran.id', $id)
                    ->get();

        return $data;
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
        
        $pesanan = Pesanan::create([
            'id_pembelian' => $validated['id_pembelian'],
            'tanggal_kirim' => $validated['tanggal_kirim'],
            'waktu_kirim' => $validated['waktu_kirim'],
            'lokasi' => $validated['lokasi'],
            'alamat' => $validated['alamat'],
            'porsi' => $validated['porsi'],
            'catatan_pelanggan' => $validated['catatan_pelanggan'] ? $validated['catatan_pelanggan'] : '-',
            'status' => 'belum',
        ]);

        Pengantaran::create([
            'id_pesanan' => $pesanan->id,
            'id_personel' => null,
            'catatan_kurir' => null,
            'catatan_pelanggan' => $validated['catatan_pelanggan'] ? $validated['catatan_pelanggan'] : '-',
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat request!',
        ]);
    }

    public function updatePengantaran(UpdatePengantaran $request, $id)
    {
        $validated = $request->validated();

        $pengantaran = Pengantaran::find($id);
        $pengantaran->catatan_pelanggan = $validated['catatan_pelanggan'] ? $validated['catatan_pelanggan'] : '-';
        
        $pesanan = Pesanan::find($pengantaran->id_pesanan);
        
        $pesanan->tanggal_kirim = $validated['tanggal_kirim'];
        $pesanan->waktu_kirim = $validated['waktu_kirim'];
        $pesanan->lokasi = $validated['lokasi'];
        $pesanan->alamat = $validated['alamat'];
        $pesanan->porsi = $validated['porsi'];
        $pesanan->catatan_pelanggan = $validated['catatan_pelanggan'] ? $validated['catatan_pelanggan'] : '-';
        
        $pengantaran->save();
        $pesanan->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengupdate pengantaran!',
        ]);
    }

    public function removePesanan($id)
    {   
        $pengantaran = Pengantaran::find($id);
        $pesanan = Pesanan::find($pengantaran->id_pesanan);
        
        $pesanan->delete();
        $pengantaran->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus pesanan!',
        ]);
    }
}
