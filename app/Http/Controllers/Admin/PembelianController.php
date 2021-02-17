<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePembelian;
use App\Http\Requests\UpdatePembelian;
use App\Paket;
use App\Pelanggan;
use App\Pembelian;
use App\Pengantaran;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
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
            return redirect('/pengantaran');
        }
        
        $pembelian = Pembelian::orderBy('tanggal_mulai')->get();
        $pelanggan = Pelanggan::all();
        $paket = Paket::all();

        // tahun sekarang
        $tahun = date('Y');

        // data pembelian perbulan di tahun sekarang
        $data_pembelian = Pembelian::all();
        $pbl_jan = 0;
        $pbl_feb = 0;
        $pbl_mar = 0;
        $pbl_apr = 0;
        $pbl_mei = 0;
        $pbl_jun = 0;
        $pbl_jul = 0;
        $pbl_ags = 0;
        $pbl_sep = 0;
        $pbl_okt = 0;
        $pbl_nov = 0;
        $pbl_des = 0;

        foreach ($data_pembelian as $dp) {
            if (date('m', strtotime($dp->waktu_simpan)) == '01') {
                $pbl_jan += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '02') {
                $pbl_feb += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '03') {
                $pbl_mar += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '04') {
                $pbl_apr += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '05') {
                $pbl_mei += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '06') {
                $pbl_jun += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '07') {
                $pbl_jul += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '08') {
                $pbl_ags += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '09') {
                $pbl_sep += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '10') {
                $pbl_okt += 1;
            } else if (date('m', strtotime($dp->waktu_simpan)) == '11') {
                $pbl_nov += 1;
            } else {
                $pbl_des += 1;
            }
        }

        return view('admin.pembelian.index', [
            'data_pembelian' => $data_pembelian,
            'pbl_jan' => $pbl_jan,
            'pbl_feb' => $pbl_feb,
            'pbl_mar' => $pbl_mar,
            'pbl_apr' => $pbl_apr,
            'pbl_mei' => $pbl_mei,
            'pbl_jun' => $pbl_jun,
            'pbl_jul' => $pbl_jul,
            'pbl_ags' => $pbl_ags,
            'pbl_sep' => $pbl_sep,
            'pbl_okt' => $pbl_okt,
            'pbl_nov' => $pbl_nov,
            'pbl_des' => $pbl_des,

            'pembelian' => $pembelian,
            'pelanggan' => $pelanggan,
            'paket' => $paket,
            'user' => Auth::guard('personel')->user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePembelian $request)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $length = 2;
        $kode_unik = substr(str_shuffle(str_repeat($x='123456789', ceil($length/strlen($x)) )),1,$length);
        
        $validated = $request->validated();

        $foto = null;
        if ($request->has('bukti_bayar')) {
            $foto = time() . '.' . $request->bukti_bayar->extension();
            $request->bukti_bayar->move(public_path('images/bukti'), $foto);
        }

        Pembelian::create([
            'id_pelanggan' => $validated['id_pelanggan'],
            'id_paket' => $validated['id_paket'],
            'bukti_bayar' => $foto,
            'status' => $validated['status'],
            'lokasi' => $validated['lokasi'],
            'alamat' => $validated['alamat'],
            'waktu_pengiriman' => $validated['waktu_pengiriman'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'kode_unik' => $kode_unik,
        ]);
        
        return redirect()
                ->route('pembelian.index')
                ->with('status', 'Pembelian berhasil ditambahkan!');
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
            return redirect('/pengantaran');
        }
        
        $pembelian = Pembelian::find($id);
        $pelanggan = Pelanggan::all();
        $paket = Paket::all();

        return view('admin.pembelian.edit', [
            'pembelian' => $pembelian,
            'pelanggan' => $pelanggan,
            'paket' => $paket,
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
    public function update(UpdatePembelian $request, $id)
    {   
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $validated = $request->validated();
        $pembelian = Pembelian::find($id);
        $bukti_bayar = $pembelian->bukti_bayar;

        $foto = null;
        if ($request->has('bukti_bayar')) {
            $foto = time() . '.' . $request->bukti_bayar->extension();
            $request->bukti_bayar->move(public_path('images/bukti'), $foto);

            if (file_exists(public_path('images/bukti/') . $bukti_bayar)) {
                unlink(public_path('images/bukti/') . $bukti_bayar);
            }

            $pembelian->bukti_bayar = $foto;
        }

        $pembelian->id_pelanggan = $validated['id_pelanggan'];
        $pembelian->id_paket = $validated['id_paket'];
        $pembelian->status = $validated['status'];

        $pembelian->save();

        return redirect()
                ->route('pembelian.index')
                ->with('status', 'Pembelian berhasil diperbaharui!');
    }

    public function verifikasi($id)
    {   
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $pembelian = Pembelian::find($id);
        
        $jumlah_porsi = $pembelian->paket->porsi;
        $tanggal_mulai = $pembelian->tanggal_mulai;
        $waktu_pengiriman = $pembelian->waktu_pengiriman;

        // mencegah verifikasi jika tanggal sudah terlewat
        if (date('Y-m-d', strtotime('today')) == $tanggal_mulai) {
            $pembelian->status = 'Batal';
            $pembelian->save();
            
            return redirect()
                    ->back()
                    ->with('status', 'Masa verifikasi sudah terlewat!');
        }

        $hari_pengiriman = explode(':', explode('|', $waktu_pengiriman)[0])[1];
        $jumlah_pengiriman = count(explode(',', explode(':', explode('|', $waktu_pengiriman)[1])[1]));

        $tanggal = $tanggal_mulai;
        $tanggal_pesanan = [];

        $lama_habis_porsi = $jumlah_porsi / $jumlah_pengiriman;
 
        if (strpos($hari_pengiriman, '-')) {
            if (strpos($hari_pengiriman, 'jumat')) {
                for ($i = 0; $i < $lama_habis_porsi; $i++) {

                    if (date('w', strtotime($tanggal)) == 6) {
                        $tanggal = date('Y-m-d', strtotime($tanggal . ' + 2 days'));
                    }

                    $tanggal_pesanan[] = $tanggal;
                    $tanggal = date('Y-m-d', strtotime($tanggal . ' + 1 days'));
                }

                $waktu_kirim = explode(',', explode(':', explode('|', $waktu_pengiriman)[1])[1]);
                foreach ($tanggal_pesanan as $tanggal) {

                    for ($i = 0; $i < count($waktu_kirim); $i++) {
                        $pesanan = Pesanan::create([
                            'id_pembelian' => $id,
                            'tanggal_kirim' => $tanggal,
                            'waktu_kirim' => $waktu_kirim[$i],
                            'lokasi' => $pembelian->lokasi,
                            'alamat' => $pembelian->alamat,
                            'porsi' => 1,
                            'catatan_pelanggan' => null,
                            'keterangan_pelanggan' => $pembelian->pelanggan->keterangan,
                        ]);

                        Pengantaran::create([
                            'id_pesanan' => $pesanan->id,
                            'id_personel' => null,
                            'catatan_kurir' => null,
                            'status' => 'pending',
                        ]);
                    }

                }
            } else {
                for ($i = 0; $i < $lama_habis_porsi; $i++) {

                    if (date('w', strtotime($tanggal)) == 0) {
                        $tanggal = date('Y-m-d', strtotime($tanggal . ' + 1 days '));
                    }

                    $tanggal_pesanan[] = $tanggal;
                    $tanggal = date('Y-m-d', strtotime($tanggal . ' + 1 days'));
                }

                $waktu_kirim = explode(',', explode(':', explode('|', $waktu_pengiriman)[1])[1]);
                foreach ($tanggal_pesanan as $tanggal) {

                    for ($i = 0; $i < count($waktu_kirim); $i++) {
                        $pesanan = Pesanan::create([
                            'id_pembelian' => $id,
                            'tanggal_kirim' => $tanggal,
                            'waktu_kirim' => $waktu_kirim[$i],
                            'lokasi' => $pembelian->lokasi,
                            'alamat' => $pembelian->alamat,
                            'porsi' => 1,
                            'catatan_pelanggan' => null,
                            'keterangan_pelanggan' => $pembelian->pelanggan->keterangan,
                        ]);

                        Pengantaran::create([
                            'id_pesanan' => $pesanan->id,
                            'id_personel' => null,
                            'catatan_kurir' => null,
                            'status' => 'pending',
                        ]);
                    }

                }
            }
        } else {
            $GLOBALS['daftar_hari'] = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];

            $index_hari_pengiriman = array_map(function ($h) {
                return array_search($h, $GLOBALS['daftar_hari']);
            }, explode(',', $hari_pengiriman));
            
            $jumlah_hari_skip = count(explode(',', $hari_pengiriman));
            
            for ($i = 0; $i < (7 * $lama_habis_porsi) / $jumlah_hari_skip; $i++) {
                if (in_array(date('w', strtotime($tanggal)), $index_hari_pengiriman)) {
                    $tanggal_pesanan[] = $tanggal;
                }

                $tanggal = date('Y-m-d', strtotime($tanggal . ' + 1 days'));
            }

            $waktu_kirim = explode(',', explode(':', explode('|', $waktu_pengiriman)[1])[1]);
            foreach ($tanggal_pesanan as $tanggal) {

                for ($i = 0; $i < count($waktu_kirim); $i++) {
                    $pesanan = Pesanan::create([
                        'id_pembelian' => $id,
                        'tanggal_kirim' => $tanggal,
                        'waktu_kirim' => $waktu_kirim[$i],
                        'lokasi' => $pembelian->lokasi,
                        'alamat' => $pembelian->alamat,
                        'porsi' => 1,
                        'catatan_pelanggan' => null,
                        'keterangan_pelanggan' => $pembelian->pelanggan->keterangan,
                    ]);

                    Pengantaran::create([
                        'id_pesanan' => $pesanan->id,
                        'id_personel' => null,
                        'catatan_kurir' => null,
                        'status' => 'pending',
                    ]);
                }
            }
        }
        
        $pembelian->status = 'Aktif';
        $pembelian->save();

        return redirect()
                ->route('pembelian.index')
                ->with('status', 'Berhasil verifikasi pembelian!');
    }

    public function batalkan($id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $pembelian = Pembelian::find($id);
        $pembelian->status = 'Batal';

        $bukti_bayar = $pembelian->bukti_bayar;

        if (!is_null($bukti_bayar)) {
            // hapus foto bukti pembayaran
            if (file_exists(public_path('images/bukti/') . $bukti_bayar)) {
                unlink(public_path('images/bukti/') . $bukti_bayar);
            }
        }

        $pembelian->bukti_bayar = null;
        $pembelian->save();

        return redirect()
                ->route('pembelian.index')
                ->with('status', 'Pembelian berhasil dibatalkan!');
    }

    public function selesai($id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $pembelian = Pembelian::find($id);
        $pembelian->status = 'Selesai';
        $pembelian->save();
        
        // hapus seluruh pesanan dengan id pembelian terkait
        DB::table('pesanan')->where('id_pembelian', $id)->delete();

        return redirect()
                ->route('pembelian.index')
                ->with('status', 'Pembelian telah diselesaikan!');
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
            return redirect('/pengantaran');
        }
        
        $pembelian = Pembelian::find($id);
        $bukti_bayar = $pembelian->bukti_bayar;

        if (!is_null($bukti_bayar)) {
            // hapus foto bukti pembayaran
            if (file_exists(public_path('images/bukti/') . $bukti_bayar)) {
                unlink(public_path('images/bukti/') . $bukti_bayar);
            }
        }

        $pembelian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus pembelian!',
        ]);
    }
}
