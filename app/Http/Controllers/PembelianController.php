<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembelian;
use App\Http\Requests\UpdatePembelian;
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
    public function storePembelian(StorePembelian $request)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }
        
        $length = 2;
        $kode_unik = substr(str_shuffle(str_repeat($x='123456789', ceil($length/strlen($x)) )),1,$length);

        $pembelian = Pembelian::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_paket' => $request->id_paket,
            'lokasi' => $request->lokasi,
            'alamat' => $request->alamat,
            'waktu_pengiriman' => $request->waktu_pengiriman,
            'tanggal_mulai' => $request->tanggal_mulai,
            'kode_unik' => $kode_unik,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat pembelian!',
            'data' => $pembelian,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePembelian(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }
        
        $pembelian = Pembelian::find($id);
        
        $extensions = ['jpeg', 'jpg', 'png'];
        $ext = last(explode('/', explode(';', $request->bukti_bayar)[0]));

        if (!in_array($ext, $extensions)) {
            return response()
                    ->json([
                        'success' => false,
                        'message' => 'Ekstensi gambar tidak tepat!',
                    ]);
        }

        $bukti_bayar = time() . '.' . $ext;
        \Image::make($request->bukti_bayar)->save(public_path('images/bukti/') . $bukti_bayar);

        $pembelian->bukti_bayar = $bukti_bayar;
        $pembelian->status = 'Proses verifikasi';

        $pembelian->save();
           
        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan pembayaran!',
        ]);
    }

    /**
     * Delete the specified resource in storage
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deletePembelian($id)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }
        
        $pembelian = Pembelian::find($id);
        $pembelian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membatalkan pembelian',
        ]);
    }
}
