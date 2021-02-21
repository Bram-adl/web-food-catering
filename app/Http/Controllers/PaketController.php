<?php

namespace App\Http\Controllers;

use App\Paket;
use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    /**
     * Process the related paket
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
     * Return the pengiriman paket details page
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
        
        /**
         * Kode berikut untuk melakukan pengecekan
         * apabila user yang "logged in" merupakan
         * orang yang melakukan pembelian.
         * 
         * Kita membandingkan nilai id pada query
         * dengan id pada auth untuk menghindari
         * client a melakukan pemalsuan pembelian 
         * dengan id client b.
         */
        $id_user = Auth::user()->id;
        $id_client = $request->query()['client_id'];
        
        if ($id_user != $id_client) {
            return redirect()->route('client-index');
        }

        /**
         * Kode berikut untuk melalukan pengecekan
         * apabila pembelian sebelumnya sudah tersimpan
         * sehingga menghindari duplikasi ketika user
         * tidak sengaja logged out atau mematikan
         * koneksi internet.
         */
        $pembelian = Pembelian::where([
            'id_paket' => $id,
            'id_pelanggan' => $id_user,
            'status' => 'Belum bayar',
        ])->get();

        if (count($pembelian)) {
            return redirect()
                    ->route('client-pembayaran', [
                        'id_paket' => $id,
                        'client_id' => $id_client,
                        'payment_id' => $pembelian[0]->id,
                    ]);
        }
        
        return view('client.order.delivery', [
            'paket' => Paket::find($id),
            'user' => Auth::user(),
        ]);
    }

    /**
     * Return the pembayaran paket page
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

        $id_pembelian = $request['payment_id'];
        $pembelian = Pembelian::find($id_pembelian);

        $id_user = Auth::user()->id;
        $id_client = $request->query()['client_id'];
        
        if ($id_user != $id_client) {
            return redirect()->route('client-index');
        }

        $id_pembelian = $request->payment_id;
        $pembelian = Pembelian::find($id_pembelian);

        if (!is_null($pembelian->bukti_bayar)) {
            return redirect()
                    ->route('client-index');
        }

        if ($pembelian->status == 'Batal') {
            return redirect()
                    ->route('client-index');
        }

        $check = DB::table('pembelian')
            ->select('id', 'id_pelanggan', 'id_paket')
            ->where([
                ['id_paket', $id],
                ['id_pelanggan', $id_client],
                ['id', $id_pembelian],
            ])
            ->get();
            
        if (!count($check)) {
            return redirect()
                    ->route('client-index');
        }
        
        return view('client.order.payment', [
            'paket' => Paket::find($id),
            'user' => Auth::user(),
            'pembelian' => $pembelian,
            'paket' => $pembelian->paket,
        ]);
    }
}
