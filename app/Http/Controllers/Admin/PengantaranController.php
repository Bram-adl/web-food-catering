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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $jam = date('H');

        if ($jam < 7 && $jam >= 17) {
            $waktu = 'Pagi';
        } else if ($jam >= 7 && $jam < 11) {
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // mengubah status pesanan menjadi siap
        DB::table('pesanan')->where('id', $request->id_pesanan)
        ->update([
            'status' => 'siap',
        ]);
    
        Pengantaran::create([
            'id_pesanan' => $request->id_pesanan,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Pesanan siap diantarkan!',
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
        $pengantaran = Pengantaran::find($id);

        $pengantaran->id_personel = Auth::guard('personel')->user()->id;
        $pengantaran->catatan_kurir = $request->catatan_kurir;
        $pengantaran->status = $request->status;
        
        $pengantaran->save();

        // mengupdate jumlah porsi pembeliannya
        if ($pengantaran->status == 'terkirim') {
            $pesanan = DB::table('pesanan')->where('id', $pengantaran->id_pesanan)->get();
            $id_pembelian = $pesanan[0]->id_pembelian;

            $pembelian = DB::table('pembelian')
                            ->where('id', $id_pembelian)
                            ->get();
            $porsi = $pembelian[0]->porsi;

            if ($porsi != 1) {
                DB::table('pembelian')
                    ->where('id', $id_pembelian)
                    ->update([
                        'porsi' => $porsi - $pesanan[0]->porsi
                    ]);
            } else {
                DB::table('pembelian')
                    ->where('id', $id_pembelian)
                    ->update([
                        'porsi' => $porsi - $pesanan[0]->porsi
                    ]);
                
                DB::table('pembelian')
                    ->where('id', $id_pembelian)
                    ->update([
                        'status' => 'Selesai',
                    ]);

                DB::table('pesanan')
                    ->where('id_pembelian', $id_pembelian)
                    ->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyimpan pengantaran!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
