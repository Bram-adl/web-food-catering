<?php

namespace App\Http\Controllers;

use App\Paket;
use App\Pelanggan;
use App\Pengantaran;
use App\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:personel');
    }
    
    /**
     * Return the index page.
     * 
     * @return view
     */
    public function index()
    {
        $user = Auth::guard('personel')->user();

        $jml_personel = Personel::count();
        $jml_paket = Paket::count();
        $jml_pelanggan = Pelanggan::count();
        $jml_pengiriman = Pengantaran::where('status', 'terkirim')->count();
        
        return view('admin.dashboard', [
            'user' => $user,
            'jml_personel' => $jml_personel,
            'jml_paket' => $jml_paket,
            'jml_pelanggan' => $jml_pelanggan,
            'jml_pengiriman' => $jml_pengiriman,
        ]);
    }
}
