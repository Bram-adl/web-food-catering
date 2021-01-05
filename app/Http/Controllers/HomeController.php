<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    /**
     * Return the index page
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
     * Return the delivery page
     * 
     * @return view
     */
    public function delivery($foodId)
    {
        return view('client.delivery', [
            'foodId' => $foodId,
        ]);
    }
}
