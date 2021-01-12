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
     * Return the profile page.
     * 
     * @return view
     */
    public function profile($nama)
    {
        return view('client.profile', [
            'user' => Auth::user(),
            'kota' => DB::table('kota')->get(),
            'kecamatan' => DB::table('kecamatan')->get(),
            'kelurahan' => DB::table('kelurahan')->get(),
        ]);
    }
}
