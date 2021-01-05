<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        
        return view('client.index', [
            'foods' => $foods,
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
            return redirect()->route('client-login', [
                'intended' => $id,
            ]);
        } 
        
        return view('client.package', ['id' => $id]);
    }

    /**
     * Return the login page for user login.
     * 
     * @return view
     */
    public function login()
    {
        return view('client.auth.login');
    }

    /**
     * Authenticated the user.
     * 
     * @param Request $request
     * @return redirect
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        
        return $request->all();
    }

    /**
     * Store the user to database.
     * 
     * @param Request $request
     * @return redirect
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pelanggan',
            'password' => 'required|string|min:4',
        ]);
        
        return $request->all();
    }
}
