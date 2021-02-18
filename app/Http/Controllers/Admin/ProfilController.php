<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfile;
use App\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
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
     * Return the profil page.
     * 
     * @return view
     */
    public function index()
    {
        return redirect('/profil/' . Auth::guard('personel')->user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_auth = Auth::guard('personel')->user();

        $id_user_auth = $user_auth->id;
        
        if ($id_user_auth != $id) {
            return redirect('/profil/' . Auth::guard('personel')->user()->id);
        }

        $user = DB::table('personel')
            ->join('jabatan', 'jabatan.id', 'personel.id_jabatan')
            ->join('kelurahan', 'kelurahan.id', 'personel.id_kelurahan')
            ->join('kecamatan', 'kecamatan.id', 'personel.id_kecamatan')
            ->join('kota', 'kota.id', 'personel.id_kota')
            ->where('personel.id', $id)
            ->get();

        $kota = DB::table('kota')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();
        
        return view('admin.profil', ['id' => $id], [
            'user_auth' => $user,
            'user' => $user_auth,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'personelJabatan' => $this->getPersonelJabatan(),
        ]);
    }

    public function editBiodata(UpdateProfile $request, $id)
    {
        $validated = $request->validated();

        $user = Personel::find($id);

        $user->nama = $validated['nama'];
        $user->wa = $validated['wa'];
        $user->jenis_kelamin = $validated['jenis_kelamin'];
        $user->tempat_lahir = $validated['tempat_lahir'];
        $user->tanggal_lahir = $validated['tanggal_lahir'];
        $user->alamat = $validated['alamat'];
        $user->id_kota = $validated['id_kota'];
        $user->id_kecamatan = $validated['id_kecamatan'];
        $user->id_kelurahan = $validated['id_kelurahan'];

        $user->save();

        return redirect()
                ->action('Admin\ProfilController@show', ['profil' => $user->id])
                ->with('status', 'Berhasil mengupdate profile!');
    }

    public function editFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:2024',
        ]);

        $personel = Personel::find($id);
        $personel_foto = $personel->foto;

        if ($request->has('foto')) {
            $foto = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('images/personel'), $foto);

            if (file_exists(public_path('images/personel/') . $personel_foto)) {
                unlink(public_path('images/personel/') . $personel_foto);
            }

            $personel->foto = $foto;
        } 
        
        $personel->save();

        return redirect()
                ->back()
                ->with('status', 'Berhasil memperbaharui foto!');
    }

    public function editPassword(Request $request, $id)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|confirmed|string|min:4',
            'password_baru_confirmation' => 'required|string|min:4',
        ]);

        $personel = Personel::find($id);
        $personel_password = $personel->password;

        $check_password = Hash::check($request->password_lama, $personel_password);

        if ($check_password) {
            $personel->password = Hash::make($request->password_baru);
            $personel->save();
            
            return redirect()
                    ->back()
                    ->with('status', 'Berhasil memperbaharui password!');

        } else {
            return redirect()
                    ->back()
                    ->with('error', 'Password tidak sama!');
        }
        
        return $id;
    }
}
