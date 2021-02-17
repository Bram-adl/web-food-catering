<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pembelian;
use App\Pengantaran;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengantaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:personel');
    }

    public function checkPersonel()
    {
        $personel = Auth::guard('personel')->user();

        $jabatan = DB::table('jabatan')
                        ->join('personel', 'personel.id_jabatan', 'jabatan.id')
                        ->select(
                            'jabatan.id', 'jabatan.jabatan', 'personel.id AS personel_id'
                        )
                        ->get();
                        
        $jb = null;
        foreach ($jabatan as $j) {
            if ($j->personel_id == $personel->id) {
                $jb = $j->jabatan;
            }
        }

        if (
            $jb == 'Chief Executive Officer' ||
            $jb == 'Chief Operating Officer' ||
            $jb == 'Chief Technology Officer' ||
            $jb == 'Food Courier'
        ) {
            return true;
        } else { return false; }
    }

    public function getPersonelJabatan()
    {
        $personel = Auth::guard('personel')->user();

        $jabatan = DB::table('jabatan')
                        ->join('personel', 'personel.id_jabatan', 'jabatan.id')
                        ->select(
                            'jabatan.id', 'jabatan.jabatan', 'personel.id AS personel_id'
                        )
                        ->get();
                        
        $jb = null;
        foreach ($jabatan as $j) {
            if ($j->personel_id == $personel->id) {
                $jb = $j->jabatan;
            }
        }
        
        return $jb;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->checkPersonel()) {
            return redirect('/pesanan');
        }
        
        date_default_timezone_set('Asia/Jakarta');

        $jam = date('H');

        if ($jam < 7 || $jam >= 17) {
            $waktu = 'Pagi';
        } else if ($jam >= 7 || $jam < 11) {
            $waktu = 'Siang';
        } else {
            $waktu = 'Sore';
        }
        
        $pengantaran = DB::table('pengantaran AS pg')
                            ->join('pesanan AS ps', 'ps.id', 'pg.id_pesanan')
                            ->join('pembelian AS pb', 'pb.id', 'ps.id_pembelian')
                            ->join('pelanggan AS pl', 'pl.id', 'pb.id_pelanggan')
                            ->join('paket AS pk', 'pk.id', 'pb.id_paket')
                            ->select(
                                'pg.id', 'pl.nama', 'pl.rumah_teks', 'pl.rumah_maps', 'pl.kantor_teks', 'pl.kantor_maps', 
                                'ps.porsi AS porsi_pemesanan', 'ps.lokasi AS lokasi_pemesanan', 'pl.wa',
                                'ps.catatan_pelanggan', 'pg.catatan_kurir', 'ps.waktu_kirim', 'pg.status',
                            )
                            ->where([
                                ['ps.waktu_kirim', strtolower($waktu)],
                                ['ps.tanggal_kirim', date('Y-m-d', strtotime('today'))]
                            ])
                            ->get();
        
        return view('admin.pengantaran.index', [
            'user' => Auth::guard('personel')->user(),
            'waktu' => $waktu,
            'pengantaran' => $pengantaran,
            'personelJabatan' => $this->getPersonelJabatan(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pesanan');
        }
        
        $pengantaran = Pengantaran::find($id);
        $pesanan = Pesanan::find($pengantaran->id_pesanan);
        $pembelian = Pembelian::find($pesanan->id_pembelian);

        // mengurangi jumlah porsi pembelian sebanyak porsi pengantaran
        $pembelian->porsi = $pembelian->porsi - $request->jml_porsi;

        if ($pembelian->porsi <= 0) {
            $pembelian->status = 'Selesai';

            $pesanan_terkait = Pesanan::where('id_pembelian', $pembelian->id)->get();
            $pesanan_terkait->delete();
        }
        
        $pembelian->save();
        
        $pengantaran = Pengantaran::find($id);
        $pengantaran->catatan_kurir = $request->catatan_kurir;
        $pengantaran->status = $request->status;
        $pengantaran->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Pesanan telah dikirimkan!',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pesanan');
        }
        
        $pengantaran = Pengantaran::find($id);
        $pesanan = Pesanan::find($pengantaran->id_pesanan);
        $pembelian = Pembelian::find($pesanan->id_pembelian);

        // mengurangi jumlah porsi pembelian sebanyak porsi pengantaran
        $pembelian->porsi = $pembelian->porsi + $request->jml_porsi;
        $pembelian->save();
        
        $pengantaran = Pengantaran::find($id);
        $pengantaran->catatan_kurir = $request->catatan_kurir;
        $pengantaran->status = $request->status;
        $pengantaran->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Pesanan sedang diedit!',
        ]);
    }
}
