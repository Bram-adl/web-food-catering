<?php

namespace App\Http\Controllers;

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
        if(Auth::check()) {
            return redirect()->route('client-profile', [
                'id' => Auth::id(),
                'nama' => (join("", explode(" ", Auth::user()->nama))), 
            ]);
        } else {
            return redirect()->route('client-login');
        }
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
        $pelanggan = Pelanggan::find($id);
        
        return view('client.profile', [
            'pelanggan' => $pelanggan,
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
        
        return view('client.package', ['id' => $id]);
    }

    
}
