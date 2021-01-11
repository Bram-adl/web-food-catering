<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaket;
use App\Http\Requests\UpdatePaket;
use App\Kategori;
use App\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paket = Paket::latest()->get();
        $kategori = Kategori::all();
    
        return view('admin.paket.index', [
            'paket' => $paket,
            'kategori' => $kategori,
            'user' => Auth::guard('personel')->user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaket $request)
    {
        $validated = $request->validated();

        $foto = null;
        if ($request->has('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/foods'), $foto);
        }
        
        Paket::create([
            'paket' => $validated['paket'],
            'porsi' => $validated['porsi'],
            'id_kategori' => $validated['id_kategori'],
            'harga' => $validated['harga'],
            'foto' => $foto,
            'pagi' => $validated['pagi'],
            'siang' => $validated['siang'],
            'sore' => $validated['sore'],
        ]);

        return redirect()
                ->route('paket.index')
                ->with('status', 'Paket berhasil disimpan!');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paket = Paket::find($id);
        $kategori = Kategori::all();

        return view('admin.paket.edit', [
            'paket' => $paket,
            'kategori' => $kategori,
            'user' => Auth::guard('personel')->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaket $request, $id)
    {
        $validated = $request->validated();

        $paket = Paket::find($id);
        $paket_foto = $paket->foto;
        
        if ($request->has('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/foods'), $foto);

            if (!is_null($paket_foto)) {
                if (file_exists(public_path('images/foods/') . $paket_foto)) {
                    unlink(public_path('images/foods/') . $paket_foto);
                }
            }

            $paket->foto = $foto;
        }

        $paket->paket = $validated['paket'];
        $paket->porsi = $validated['porsi'];
        $paket->id_kategori = $validated['id_kategori'];
        $paket->harga = $validated['harga'];
        $paket->pagi = $validated['pagi'];
        $paket->siang = $validated['siang'];
        $paket->sore = $validated['sore'];

        $paket->save();
        
        return redirect()
                ->route('paket.index')
                ->with('status', 'Paket berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paket = Paket::find($id);
        $paket_foto = $paket->foto;

        if(file_exists(public_path('images/foods/') . $paket_foto)) {
            unlink(public_path('images/foods/') . $paket_foto);
        }
        
        $paket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus paket ' . $paket->paket . '!',
        ]);
    }
}
