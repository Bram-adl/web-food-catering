<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pelanggan;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
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
        $pesanan = DB::table('pesanan AS ps')
                    ->join('pembelian AS pb', 'pb.id', 'ps.id_pembelian')
                    ->join('pelanggan AS pl', 'pl.id', 'pb.id_pelanggan')
                    ->join('paket AS pk', 'pk.id', 'pb.id_paket')
                    ->select(
                        'ps.id', 'pl.nama', 'pk.paket AS paket', 'ps.porsi', 'pl.wa', 'ps.waktu_kirim', 'pb.porsi AS sisa_porsi',
                        'pl.keterangan', 'ps.catatan_pelanggan', 'ps.tanggal_kirim',
                    )
                    ->where([
                        'ps.tanggal_kirim' => date('Y-m-d', strtotime('today')),
                        'ps.status' => 'belum',
                    ])
                    ->get();
        
        return view('admin.pesanan.index', [
            'user' => Auth::guard('personel')->user(),
            'pesanan' => $pesanan,
            'tanggal' => date('d M Y', strtotime('today')),
        ]);
    }

    public function tanggal(Request $request)
    {
        $tanggal_kirim = $request->tanggal;

        $pesanan = DB::table('pesanan AS ps')
                    ->join('pembelian AS pb', 'pb.id', 'ps.id_pembelian')
                    ->join('pelanggan AS pl', 'pl.id', 'pb.id_pelanggan')
                    ->join('paket AS pk', 'pk.id', 'pb.id_paket')
                    ->select(
                        'ps.id', 'pl.nama', 'pk.paket AS paket', 'ps.porsi', 'pl.wa', 'ps.waktu_kirim', 'pb.porsi AS sisa_porsi',
                        'pl.keterangan', 'ps.catatan_pelanggan', 'ps.tanggal_kirim',
                    )
                    ->where([
                        'ps.tanggal_kirim' => $tanggal_kirim,
                        'ps.status' => 'belum',
                    ])
                    ->get();
        
        return view('admin.pesanan.index', [
            'user' => Auth::guard('personel')->user(),
            'pesanan' => $pesanan,
            'tanggal' => date('d M Y', strtotime($tanggal_kirim)),
        ]);
    }

    public function serve()
    {
        return "ok";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
