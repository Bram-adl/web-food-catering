<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJabatan;
use App\Http\Requests\UpdateJabatan;
use App\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
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
        
        $jabatan = Jabatan::latest()->get();

        return view('admin.jabatan.index', [
            'jabatan' => $jabatan,
            'user' => Auth::guard('personel')->user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJabatan $request)
    {
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
        $validated = $request->validated();
        
        Jabatan::create([
            'jabatan' => $validated['jabatan'],
            'keterangan' => $validated['keterangan'],
            'warna' => $validated['warna'],
        ]);

        return redirect()
            ->route('jabatan.index')
            ->with('status', 'Jabatan berhasil disimpan!');
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
        
        $jabatan = Jabatan::find($id);

        return view('admin.jabatan.edit', [
            'jabatan' => $jabatan,
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
    public function update(UpdateJabatan $request, $id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
        $validated = $request->validated();

        $jabatan = Jabatan::find($id);
        $jabatan->jabatan = $validated['jabatan'];
        $jabatan->keterangan = $validated['keterangan'];
        $jabatan->warna = $validated['warna'];
        
        $jabatan->save();

        return redirect()
                ->route('jabatan.index')
                ->with('status', 'Jabatan berhasil diperbaharui!');
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
        
        $jabatan = Jabatan::find($id);
        $jabatan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data!',
        ]);
    }
}
