<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonel;
use App\Http\Requests\UpdatePersonel;
use App\Jabatan;
use App\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PersonelController extends Controller
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
        
        $personel = Personel::paginate(3);
        $list_personel = Personel::all();
        $jabatan = Jabatan::all();

        $kota = DB::table('kota')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();

        $jml_laki = Personel::where('jenis_kelamin', 'Laki-laki')->count();
        $jml_perempuan = Personel::where('jenis_kelamin', 'Perempuan')->count();

        $jabatan = Jabatan::all();
        
        return view('admin.personel.index', [
            'personel' => $personel,
            'list_personel' => $list_personel,
            'jabatan' => $jabatan,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'user' => Auth::guard('personel')->user(),
            'jml_laki' => $jml_laki,
            'jml_perempuan' => $jml_perempuan,
            'jabatan' => $jabatan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonel $request)
    {   
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
        $validated = $request->validated();

        // upload the image
        $foto = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images/personel'), $foto);
        
        // store to db
        Personel::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'id_jabatan' => $validated['id_jabatan'],
            'nik' => $validated['nik'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'wa' => $validated['wa'],
            'alamat' => $validated['alamat'],
            'id_kota' => $validated['id_kota'],
            'id_kecamatan' => $validated['id_kecamatan'],
            'id_kelurahan' => $validated['id_kelurahan'],
            'foto' => $foto,
        ]);

        return redirect()
            ->route('personel.index')
            ->with('status', 'Personel berhasil ditambahkan');
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
        
        $personel = Personel::find($id);
        $jabatan = Jabatan::all();

        $kota = DB::table('kota')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();

        return view('admin.personel.edit', [
            'personel' => $personel,
            'jabatan' => $jabatan,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
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
    public function update(UpdatePersonel $request, $id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/dashboard');
        }
        
        $validated = $request->validated();

        $personel = Personel::find($id);
        $personel_foto = $personel->foto;
        $personel_password = $personel->password;
        
        // if photo is updated
        if ($request->has('foto')) {
            
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/personel'), $foto);

            if (file_exists(public_path('images/personel/') . $personel_foto)) {
                unlink(public_path('images/personel/') . $personel_foto);
            }

            $personel->foto = $foto;
        }

        if ($personel_password != $request->password) {
            $personel->password = Hash::make($request->password);
        }

        $personel->nama = $validated['nama'];
        $personel->id_jabatan = $validated['id_jabatan'];
        $personel->wa = $validated['wa'];
        $personel->jenis_kelamin = $validated['jenis_kelamin'];
        $personel->tempat_lahir = $validated['tempat_lahir'];
        $personel->tanggal_lahir = $validated['tanggal_lahir'];
        $personel->alamat = $validated['alamat'];
        $personel->id_kota = $validated['id_kota'];
        $personel->id_kecamatan = $validated['id_kecamatan'];
        $personel->id_kelurahan = $validated['id_kelurahan'];

        $personel->save();
        
        return redirect()
            ->route('personel.index')
            ->with('status', 'Personel berhasil diupdate!');
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
        
        $personel = Personel::find($id);

        $personel_foto = $personel->foto;
        if (file_exists(public_path('images/personel/') . $personel_foto)) {
            unlink(public_path('images/personel/') . $personel_foto);
        }
        
        $personel->delete();
    }
}
