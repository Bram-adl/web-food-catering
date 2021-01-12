<?php

namespace App\Http\Controllers;

use App\Paket;
use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    /**
     * Process the related pembelian
     * 
     * @param int $id
     * @return redirect
     */
    public function process($id)
    {
        if (!Auth::check()) {
            return redirect()
                    ->route('client-login', [
                        'auth/redirect_to' => $id,
                    ]);
        }
        
        return redirect()
                ->route('client-pengiriman', [
                    'id_paket' => $id,
                    'client_id' => Auth::user()->id,
                ]);
    }
    
    /**
     * Return the pengiriman details page
     * 
     * @param Request $request
     * @param int $id
     * @return view
     */
    public function pengiriman(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()
                    ->route('client-login', [
                        'auth/redirect_to' => $id,
                    ]);
        }
        
        $id_user = Auth::user()->id;
        $id_client = $request->query()['client_id'];
        
        if ($id_user != $id_client) {
            return redirect()->route('client-index');
        }
        
        return view('client.delivery', [
            'paket' => Paket::find($id),
            'user' => Auth::user(),
        ]);
    }

    /**
     * Return the pembayaran page
     * 
     * @param Request $request
     * @param int $id
     * @return view
     */
    public function pembayaran(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()
                    ->route('client-login', [
                        'auth/redirect_to' => $id,
                    ]);
        }
        
        return view('client.payment', [
            'paket' => Paket::find($id),
            'user' => Auth::user(),
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
}
