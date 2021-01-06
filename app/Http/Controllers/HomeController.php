<?php

namespace App\Http\Controllers;

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
     * Return the profile page of the given user.
     * 
     * @param Int $id
     * @param String $nama
     * @return view
     */
    public function profile($id, $nama)
    {
        return view('client.profile', [
            'id' => $id,
            'nama' => $nama,
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
