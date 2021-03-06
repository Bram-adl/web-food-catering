<?php

namespace App\Http\Controllers;

use App\Paket;
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
        if (Auth::check()) {
            return redirect()->route('client-profile', [
                'id' => Auth::id(),
                'nama' => (join("", explode(" ", Auth::user()->nama))), 
            ]);
        }

        $redirect_to = null;
        if ($request->query()) {
            $redirect_to = $request->query()['auth/redirect_to'];
        }
        
        return view('client.auth.login', [
            'redirect_to' => $redirect_to,
        ]);
    }

    public function loginAdmin()
    {
        if (Auth::guard('personel')->check()) {
            return redirect()->route('admin-dashboard');
        }
        
        return view('admin.auth.login');
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

        if (!Auth::attempt($credentials)) {
            return redirect()
                    ->back()
                    ->with('status', 'User not found.');
        } else {
            if (!$request->has('query')) {
                return redirect()->route('client-profile', [
                    'nama' => implode(explode(" ", Auth::user()->nama)),
                ]);
            } else {
                $id_paket = $request["query"];
                $id_user = Auth::user()->id;
        
                return redirect()->route('client-pengiriman', [
                    'id_paket' => $id_paket,
                    'client_id' => $id_user,
                ]);
            }
        }
    }

    public function authenticateAdmin(Request $request)
    {
        if (Auth::guard('personel')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('personel')->user();
            
            return redirect()
                ->route('admin-dashboard')
                ->with('status', 'Selamat datang, ' . $user->nama . '!');
        } else {
            return redirect()
                ->route('admin-login')
                ->with('status', 'Akun tidak ditemukan');
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

        if (!Auth::attempt($credentials)) {
            return redirect()
                    ->back()
                    ->with('status', 'User not found.');
        } else {
            if (!$request->has('query')) {
                return redirect()->route('client-profile', [
                    'nama' => implode(explode(" ", Auth::user()->nama)),
                ]);
            } else {
                $id_paket = $request["query"];
                $id_user = Auth::user()->id;
        
                return redirect()->route('client-pengiriman', [
                    'id_paket' => $id_paket,
                    'client_id' => $id_user,
                ]);
            }
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

    public function logoutAdmin()
    {
        Auth::guard('personel')->logout();

        return redirect()->route('admin-login');
    }
}
