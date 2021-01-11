<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategori;
use App\Http\Requests\UpdateKategori;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::latest()->get();
        return view('admin.kategori.index', [
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
    public function store(StoreKategori $request)
    {
        $validated = $request->validated();

        Kategori::create([
            'kategori' => $validated['kategori'],
            'keterangan' => $validated['keterangan'],
        ]);
        
        return redirect()
                ->route('kategori.index')
                ->with('status', 'Kategori berhasil disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('admin.kategori.edit', [
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
    public function update(UpdateKategori $request, $id)
    {
        $validated = $request->validated();

        $kategori = Kategori::find($id);

        $kategori->kategori = $validated['kategori'];
        $kategori->keterangan = $validated['keterangan'];
        
        $kategori->save();

        return redirect()
                ->route('kategori.index')
                ->with('status', 'Kategori berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus kategori ' . $kategori->kategori . '!',
        ]);
    }
}
