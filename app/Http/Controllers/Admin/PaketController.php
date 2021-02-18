<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaket;
use App\Http\Requests\UpdatePaket;
use App\Kategori;
use App\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:personel');
    }

    public function checkPersonel()
    {
        $personel = Auth::guard('personel')->user();

        $jabatan = DB::table('jabatan')
                        ->join('personel', 'personel.id_jabatan', 'jabatan.id')
                        ->select(
                            'jabatan.id', 'jabatan.jabatan', 'personel.id AS personel_id'
                        )
                        ->get();
                        
        $jb = null;
        foreach ($jabatan as $j) {
            if ($j->personel_id == $personel->id) {
                $jb = $j->jabatan;
            }
        }

        if (
            $jb == 'Chief Executive Officer' ||
            $jb == 'Chief Operating Officer' ||
            $jb == 'Chief Technology Officer'
        ) {
            return true;
        } else { return false; }
    }
    

    public function getPersonelJabatan()
    {
        $personel = Auth::guard('personel')->user();

        $jabatan = DB::table('jabatan')
                        ->join('personel', 'personel.id_jabatan', 'jabatan.id')
                        ->select(
                            'jabatan.id', 'jabatan.jabatan', 'personel.id AS personel_id'
                        )
                        ->get();
                        
        $jb = null;
        foreach ($jabatan as $j) {
            if ($j->personel_id == $personel->id) {
                $jb = $j->jabatan;
            }
        }

        return $jb;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
        $paket = Paket::latest()->get();
        $kategori = Kategori::all();
    
        return view('admin.paket.index', [
            'paket' => $paket,
            'kategori' => $kategori,
            'user' => Auth::guard('personel')->user(),
            'personelJabatan' => $this->getPersonelJabatan(),
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
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
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
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
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
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
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
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
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
