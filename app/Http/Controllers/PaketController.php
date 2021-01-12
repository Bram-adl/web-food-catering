<?php

namespace App\Http\Controllers;

use App\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        return view('client.payment', [
            'paket' => Paket::find($id),
            'user' => Auth::user(),
        ]);
    }
}
