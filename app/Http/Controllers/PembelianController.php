<?php

namespace App\Http\Controllers;

use App\Paket;
use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $length = 2;
        $kode_unik = substr(str_shuffle(str_repeat($x='123456789', ceil($length/strlen($x)) )),1,$length);
        
        $request->validate([
            'id_pelanggan' => 'required',
            'id_paket' => 'required',
            'bukti_bayar' => 'nullable|image|mimes:jpeg, jpg, png, svg|max:2048',
            'status' => 'nullable',
            'lokasi' => 'required|string',
            'alamat' => 'required|string',
            'waktu_pengiriman' => 'required',
            'tanggal_mulai' => 'required|date|after:today',
        ]);

        Pembelian::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_paket' => $request->id_paket,
            'bukti_bayar' => $request->bukti_bayar,
            'status' => $request->status,
            'lokasi' => $request->lokasi,
            'alamat' => $request->alamat,
            'waktu_pengiriman' => $request->waktu_pengiriman,
            'tanggal_mulai' => $request->tanggal_mulai,
            'kode_unik' => $kode_unik,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat pembelian!',
        ]);
    }
}
