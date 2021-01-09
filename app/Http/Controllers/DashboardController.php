<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.dashboard');
    }

    /**
     * Return the profil page.
     * 
     * @return view
     */
    public function profil($id)
    {
        return view('admin.profil', ['id' => $id]);
    }

    /**
     * Return the jabatan page.
     * 
     * @return view
     */
    public function jabatan()
    {
        return view('admin.jabatan');
    }

    /**
     * Return the paket page.
     * 
     * @return view
     */
    public function paket()
    {
        return view('admin.paket');
    }

    /**
     * Return the kategori-paket page.
     * 
     * @return view
     */
    public function kategori_paket()
    {
        return view('admin.kategori-paket');
    }

    /**
     * Return the pelanggan page.
     * 
     * @return view
     */
    public function pelanggan()
    {
        return view('admin.pelanggan');
    }

    /**
     * Return the pembelian page.
     * 
     * @return view
     */
    public function pembelian()
    {
        return view('admin.pembelian');
    }

    /**
     * Return the pesanan page.
     * 
     * @return view
     */
    public function pesanan()
    {
        return view('admin.pesanan');
    }

    /**
     * Return the pengantaran page.
     * 
     * @return view
     */
    public function pengantaran()
    {
        return view('admin.pengantaran');
    }
}
