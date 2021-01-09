<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePembelian;
use App\Http\Requests\UpdatePembelian;
use App\Paket;
use App\Pelanggan;
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
        $pembelian = Pembelian::latest()->get();
        $pelanggan = Pelanggan::all();
        $paket = Paket::all();

        return view('admin.pembelian.index', [
            'pembelian' => $pembelian,
            'pelanggan' => $pelanggan,
            'paket' => $paket,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePembelian $request)
    {
        $length = 2;
        $kode_unik = substr(str_shuffle(str_repeat($x='123456789', ceil($length/strlen($x)) )),1,$length);
        
        $validated = $request->validated();

        $foto = null;
        if ($request->has('bukti_bayar')) {
            $foto = time() . '.' . $request->bukti_bayar->extension();
            $request->bukti_bayar->move(public_path('images/bukti'), $foto);
        }

        Pembelian::create([
            'id_pelanggan' => $validated['id_pelanggan'],
            'id_paket' => $validated['id_paket'],
            'bukti_bayar' => $foto,
            'status' => $validated['status'],
            'lokasi' => $validated['lokasi'],
            'alamat' => $validated['alamat'],
            'waktu_pengiriman' => $validated['waktu_pengiriman'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'kode_unik' => $kode_unik,
        ]);
        
        return redirect()
                ->route('pembelian.index')
                ->with('status', 'Pembelian berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pembelian = Pembelian::find($id);
        $pelanggan = Pelanggan::all();
        $paket = Paket::all();

        return view('admin.pembelian.edit', [
            'pembelian' => $pembelian,
            'pelanggan' => $pelanggan,
            'paket' => $paket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePembelian $request, $id)
    {   
        $validated = $request->validated();
        $pembelian = Pembelian::find($id);
        $bukti_bayar = $pembelian->bukti_bayar;

        $foto = null;
        if ($request->has('bukti_bayar')) {
            $foto = time() . '.' . $request->bukti_bayar->extension();
            $request->bukti_bayar->move(public_path('images/bukti'), $foto);

            if (file_exists(public_path('images/bukti/') . $bukti_bayar)) {
                unlink(public_path('images/bukti/') . $bukti_bayar);
            }

            $pembelian->bukti_bayar = $foto;
        }

        $pembelian->id_pelanggan = $validated['id_pelanggan'];
        $pembelian->id_paket = $validated['id_paket'];
        $pembelian->status = $validated['status'];

        $pembelian->save();

        return redirect()
                ->route('pembelian.index')
                ->with('status', 'Pembelian berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian = Pembelian::find($id);
        $bukti_bayar = $pembelian->bukti_bayar;

        if (!is_null($bukti_bayar)) {
            // hapus foto bukti pembayaran
            if (file_exists(public_path('images/bukti/') . $bukti_bayar)) {
                unlink(public_path('images/bukti/') . $bukti_bayar);
            }
        }

        $pembelian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
