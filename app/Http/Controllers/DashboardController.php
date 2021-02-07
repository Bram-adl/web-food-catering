<?php

namespace App\Http\Controllers;

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
        return view('admin.dashboard', [
            'user' => $user,
        ]);
    }
}
