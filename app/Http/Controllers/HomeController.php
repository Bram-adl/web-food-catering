<?php

namespace App\Http\Controllers;

use App\Paket;
use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    
    /**
     * Return the index page.
     * 
     * @return view
     */
    public function index()
    {
        $foods = DB::table('paket')->get();
        $user = Auth::user();
        
        return view('client.index', [
            'foods' => $foods,
            'user' => $user,
        ]);
    }

    /**
     * Checks the user traits
     * 
     * @return redirect
     */
    public function profileRedirect()
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }

        return redirect()->route('client-profile', [
            'id' => Auth::id(),
            'nama' => (join("", explode(" ", Auth::user()->nama))), 
        ]);
    }

    /**
     * Return the profile page of the given user.
     * 
     * @param Int $id
     * @param String $nama
     * @return view
     */
    public function profile($id, $nama)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }
        
        $user = Auth::user();
        $kota = DB::table('kota')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();
        
        return view('client.profile', [
            'user' => $user,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
        ]);
    }

    /**
     * Return the package delivery page.
     * 
     * @return view
     */
    public function package($id)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login', ['auth/redirect_package' => $id]);
        }

        return redirect()
                ->route('client-payment', ['checkout/process_package' => $id]);
    }

    /**
     * Return the payment page.
     * 
     * @return view
     */
    public function payment(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }
        
        $id = explode('process_package=', $request->fullUrl())[1];
        $paket = Paket::find($id);
        
        return view('client.package', [
            'paket' => $paket,
        ]);
    }

    /**
     * Return the order page
     * 
     * @return view
     */
    public function order(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('client-login');
        }

        $id = explode('process_package=', $request->fullUrl())[1];
        $paket = Paket::find($id);
        
        return view('client.package', [
            'paket' => $paket,
        ]);
    }
}
