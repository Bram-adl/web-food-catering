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
        $pelanggan = DB::select('
            SELECT p.id, p.nama, p.email, p.wa, 
            p.rumah_teks, p.rumah_maps, p.rumah_kota, p.rumah_kecamatan, p.rumah_kelurahan, 
            p.kantor_teks, p.kantor_maps, p.kantor_kota, p.kantor_kecamatan, p.kantor_kelurahan, 
            p.keterangan, p.porsi, p.waktu_simpan, p.waktu_edit, p.waktu_hapus, 
            kt.kota, kc.kecamatan, kl.kelurahan 
            FROM pelanggan p 
            JOIN kota kt ON kt.id = p.rumah_kota OR kt.id = p.kantor_kota 
            JOIN kecamatan kc ON kc.id = p.rumah_kecamatan OR kc.id = p.kantor_kecamatan 
            JOIN kelurahan kl ON kl.id = p.rumah_kelurahan OR kl.id = p.rumah_kelurahan 
            WHERE p.id = ?
        ', [Auth::id()]);
        
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
