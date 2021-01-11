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
        $user = Auth::guard('personel')->user();
        return view('admin.dashboard', [
            'user' => $user,
        ]);
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
