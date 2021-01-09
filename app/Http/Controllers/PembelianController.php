<?php

namespace App\Http\Controllers;

use App\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
            'tanggal_mulai' => 'required|date',
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function pembelian($id_paket, $id_pelanggan)
    {
        $pembelian = Pembelian::where([
            'id_paket' => $id_paket,
            'id_pelanggan' => $id_pelanggan,
        ])->first();
        
        return response()->json([
            'success' => true,
            'message' => $pembelian,
        ]);
    }

    public function updatePembelian(Request $request, $id_paket, $id_pelanggan)
    {
        $pembelian = Pembelian::where([
            'id_paket' => $id_paket,
            'id_pelanggan' => $id_pelanggan,
        ])->first();

        $extension = explode('/', $request->bukti_bayar)[1];
        $extension = explode(';', $extension)[0];
        $photo = time() . '.' . $extension;

        \Image::make($request->bukti_bayar)->save(public_path('images/bukti/') . $photo);

        $pembelian->bukti_bayar = $photo;
        $pembelian->status = $request->status;

        $pembelian->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat order!',
        ]);
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
