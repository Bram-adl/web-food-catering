<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Return the login page for user login.
     * 
     * @return view
     */
    public function login(Request $request)
    {
        $redirect_to = null;

        if ($request->query()) {
            $redirect_to = $request->query()['auth/redirect_package'];
        }
        
        return view('client.auth.login', [
            'redirect_to' => $redirect_to,
            'user' => Auth::user(),
        ]);
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

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => '/',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak ditemukan',
            ]);
        }
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
        
        // Store the user to database
        DB::table('pelanggan')
            ->insert([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        // Immediately log the user after saving to database
        $credentials = $request->only('email', 'password');

        // Redirect the user to the intended page or fallback to index page
        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => '/',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak ditemukan',
            ]);
        }
    }

    /**
     * Login the authenticated user.
     * 
     * @return redirect
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('client-index');
    }
}