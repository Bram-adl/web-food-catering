<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggan = DB::select('
            SELECT p.id, p.nama, p.email, p.wa, 
            p.rumah_teks, p.rumah_maps, p.rumah_kota, p.rumah_kecamatan, p.rumah_kelurahan, 
            p.kantor_teks, p.kantor_maps, p.kantor_kota, p.kantor_kecamatan, p.kantor_kelurahan, 
            p.keterangan, p.porsi, p.waktu_simpan, p.waktu_edit, p.waktu_hapus, 
            kt.kota, kc.kecamatan, kl.kelurahan 
            FROM pelanggan p 
            JOIN kota kt ON kt.id = p.rumah_kota OR kt.id = p.kantor_kota 
            JOIN kecamatan kc ON kc.id = p.rumah_kecamatan OR kc.id = p.kantor_kecamatan 
            JOIN kelurahan kl ON kl.id = p.rumah_kelurahan OR kl.id = p.rumah_kelurahan 
            WHERE p.id = ?
        ', [$id]);

        return $pelanggan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:pelanggan,email,'.$id,
            'password' => 'sometimes',
            'wa' => [
                'nullable',
                'numeric',
                'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/',
            ],
            'rumah_teks' => 'nullable|string',
            'rumah_maps' => 'nullable|url',
            'rumah_kota' => 'nullable|numeric',
            'rumah_kecamatan' => 'nullable|numeric',
            'rumah_kelurahan' => 'nullable|numeric',
            'kantor_teks' => 'nullable|string',
            'kantor_maps' => 'nullable|url',
            'kantor_kota' => 'nullable|numeric',
            'kantor_kecamatan' => 'nullable|numeric',
            'kantor_kelurahan' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::find($id);

        // wether the user changes their password.
        if (strlen($request->password)) {
            $pelanggan->password = Hash::make($request->password);
        }

        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->wa = $request->wa;
        $pelanggan->rumah_teks = $request->rumah_teks;
        $pelanggan->rumah_maps = $request->rumah_maps;
        $pelanggan->rumah_kota = $request->rumah_kota;
        $pelanggan->rumah_kecamatan = $request->rumah_kecamatan;
        $pelanggan->rumah_kelurahan = $request->rumah_kelurahan;
        $pelanggan->kantor_teks = $request->kantor_teks;
        $pelanggan->kantor_maps = $request->kantor_maps;
        $pelanggan->kantor_kota = $request->kantor_kota;
        $pelanggan->kantor_kecamatan = $request->kantor_kecamatan;
        $pelanggan->kantor_kelurahan = $request->kantor_kelurahan;
        $pelanggan->keterangan = $request->keterangan;

        $updated = $pelanggan->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Data updated successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'An error occured unexpectedly.',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
