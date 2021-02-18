<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategori;
use App\Http\Requests\UpdateKategori;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
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
        
        $kategori = Kategori::latest()->get();
        return view('admin.kategori.index', [
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
    public function store(StoreKategori $request)
    {
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
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
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
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
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
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
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
        $kategori = Kategori::find($id);
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus kategori ' . $kategori->kategori . '!',
        ]);
    }
}
