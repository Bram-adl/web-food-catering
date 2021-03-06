<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pelanggan;
use App\Pengantaran;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
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
            $jb == 'Chief Technology Officer' ||
            $jb == 'Executive Chef' ||
            $jb == 'Cook Helper' ||
            $jb == 'Kitchen Staff' ||
            $jb == 'Packaging Staff'
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
            return redirect('/pengantaran');
        }
        
        $pesanan = DB::table('pesanan AS ps')
                    ->join('pembelian AS pb', 'pb.id', 'ps.id_pembelian')
                    ->join('pelanggan AS pl', 'pl.id', 'pb.id_pelanggan')
                    ->join('paket AS pk', 'pk.id', 'pb.id_paket')
                    ->select(
                        'ps.id', 'pl.nama', 'pk.paket AS paket', 'ps.porsi', 'pl.wa', 'ps.waktu_kirim', 'pb.porsi AS sisa_porsi',
                        'pl.keterangan', 'ps.catatan_pelanggan', 'ps.tanggal_kirim',
                    )
                    ->where([
                        'ps.tanggal_kirim' => date('Y-m-d', strtotime('tomorrow')),
                        'ps.status' => 'belum',
                    ])
                    ->get();
        
        return view('admin.pesanan.index', [
            'user' => Auth::guard('personel')->user(),
            'pesanan' => $pesanan,
            'tanggal' => date('d M Y', strtotime('tomorrow')),
            'personelJabatan' => $this->getPersonelJabatan(),
        ]);
    }

    public function tanggal(Request $request)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $tanggal_kirim = $request->tanggal;

        $pesanan = DB::table('pesanan AS ps')
                    ->join('pembelian AS pb', 'pb.id', 'ps.id_pembelian')
                    ->join('pelanggan AS pl', 'pl.id', 'pb.id_pelanggan')
                    ->join('paket AS pk', 'pk.id', 'pb.id_paket')
                    ->select(
                        'ps.id', 'pl.nama', 'pk.paket AS paket', 'ps.porsi', 'pl.wa', 'ps.waktu_kirim', 'pb.porsi AS sisa_porsi',
                        'pl.keterangan', 'ps.catatan_pelanggan', 'ps.tanggal_kirim',
                    )
                    ->where([
                        'ps.tanggal_kirim' => $tanggal_kirim,
                        'ps.status' => 'belum',
                    ])
                    ->get();
        
        return view('admin.pesanan.index', [
            'user' => Auth::guard('personel')->user(),
            'pesanan' => $pesanan,
            'tanggal' => date('d M Y', strtotime($tanggal_kirim)),

            'personelJabatan' => $this->getPersonelJabatan(),
        ]);
    }

    public function editJadwal($id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $pesanan = Pesanan::find($id);
        $tanggal_terakhir = DB::table('pesanan')->latest('tanggal_kirim')->get();
        
        return view('admin.pesanan.edit', [
            'user' => Auth::guard('personel')->user(),
            'pesanan' => $pesanan,
            'tanggal_terakhir' => $tanggal_terakhir,
        ]);
    }

    public function updateJadwal(Request $request, $id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $pesanan = Pesanan::find($id);
        
        $request->validate([
            'tanggal_baru' => 'required|date',
        ]);

        $pesanan->tanggal_kirim = $request->tanggal_baru;
        $pesanan->save();

        return redirect()
                ->route('pesanan.index')
                ->with('status', 'Berhasil memperbaharui tanggal pengiriman pesanan!');
    }

    public function serve($id)
    {
        if (!$this->checkPersonel()) {
            return redirect('/pengantaran');
        }
        
        $pesanan = Pesanan::find($id);
        $pesanan->status = 'siap';
        $pesanan->save();
        
        Pengantaran::create([
            'id_pesanan' => $id,
            'id_personel' => null,
            'catatan_kurir' => null,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('status', 'Berhasil menyiapkan hidangan!');
    }
}
