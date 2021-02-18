<?php

namespace App\Http\Controllers;

use App\Paket;
use App\Pelanggan;
use App\Pembelian;
use App\Pengantaran;
use App\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Analytics\Period;
use Analytics;

class DashboardController extends Controller
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
        
        return $jb;
    }

    public function redirectPersonel($jabatan)
    {
        if (
            $jabatan == 'Food Courier'
        ) {
            return '/pengantaran';
        } else if (
            $jabatan == 'Executive Chef' ||
            $jabatan == 'Cook Helper' ||
            $jabatan == 'Kitchen Staff' ||
            $jabatan == 'Packaging Staff'
        ) {
            return '/pesanan';
        } else {
            return '/dashboard';
        }
    }
    
    /**
     * Return the index page.
     * 
     * @return view
     */
    public function index()
    {
        if (
            $this->redirectPersonel($this->checkPersonel()) == '/pengantaran'
        ) {
            return redirect('/pengantaran');
        } else if (
            $this->redirectPersonel($this->checkPersonel()) == '/pesanan'
        ) {
            return redirect('/pengantaran');
        }
        
        $user = Auth::guard('personel')->user();

        $bulan_sekarang = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        $tujuh_bulan_yang_lalu = date('Y-m-d', strtotime($bulan_sekarang . '-7month'));

        // ======================================================================
        // DATA UNTUK CARD DI DASHBOARD
        // ======================================================================
        $jml_personel = Personel::count();
        $jml_paket = Paket::count();
        $jml_pelanggan = Pelanggan::count();
        $jml_pengiriman = Pengantaran::where('status', 'terkirim')->count();

        // ======================================================================
        // DATA UNTUK RINGKASAN LAPORAN CHART
        // ======================================================================
        $analytics = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        $number_of_visitors = 0;

        foreach ($analytics as $analytic) {
            foreach ($analytic as $a) {
                $number_of_visitors += $a->visitors;
            }
        }

        // menentukan ke-tujuh bulan sebelum bulan ini
        // menarik data visitors per masing-masing bulan
        // membuat array hash yang menyimpang bulan dengan jumlah visitornya

        // ======================================================================
        // DATA UNTUK RINGKASAN LAPORAN
        // ======================================================================
        $jml_pendaftar_dlm_tujuh_bulan = $this->getRingkasan('jumlah_pendaftar', 'pelanggan', "waktu_simpan BETWEEN ('$tujuh_bulan_yang_lalu 23:59:59') AND ('$bulan_sekarang 23:59:59')", $tujuh_bulan_yang_lalu, $bulan_sekarang);

        $jml_pembelian_dlm_tujuh_bulan = $this->getRingkasan('jumlah_pembeli', 'pembelian', "waktu_simpan BETWEEN ('$tujuh_bulan_yang_lalu 23:59:59') AND ('$bulan_sekarang 23:59:59')", $tujuh_bulan_yang_lalu, $bulan_sekarang);

        $jml_pembayaran_dlm_tujuh_bulan = $this->getRingkasan('jumlah_pembeli', 'pembelian', "(waktu_simpan BETWEEN ('$tujuh_bulan_yang_lalu 23:59:59') AND ('$bulan_sekarang 23:59:59')) AND status != 'Belum Bayar'", $tujuh_bulan_yang_lalu, $bulan_sekarang);

        // ======================================================================
        // DATA UNTUK PAKET PALING LAKU
        // ======================================================================
        $pembelian_terbanyak = DB::select("
            SELECT pembelian.lokasi, paket.paket AS paket, paket.foto AS foto, paket.id AS id_paket, COUNT(pembelian.id) AS jumlah_pembelian
            FROM pembelian
            JOIN paket ON pembelian.id_paket = paket.id
            GROUP BY pembelian.id_paket 
            ORDER BY jumlah_pembelian DESC 
            LIMIT 5
        ");

        // ======================================================================
        // DATA UNTUK PERFORMA PENJUALAN
        // ======================================================================
        $bulan_ini = date('m');
        $bulan_berikutnya = null;
        
        $tahun_ini = date('Y');

        if ($bulan_ini >= '10') {
            $bulan_berikutnya = $bulan_ini + 1;
        } else {
            $bulan_berikutnya = '0' . ($bulan_ini + 1);
        }

        if ($bulan_ini == '01') {
            $tahun_ini -= 1;
            $bulan_ini = '13';
        }

        $pembelian_bulan_ini = 
            $this->getPembelian(
                "$tahun_ini-$bulan_ini-01", 
                "$tahun_ini-$bulan_berikutnya-01"
            );

        $pembelian_bulan_sebelumnya = 
            $this->getPembelian(
                "$tahun_ini-" . ($bulan_ini - 1) . "-01", 
                "$tahun_ini-" . ($bulan_berikutnya - 1) ."-01"
            );

        $total_bulan_ini = $pembelian_bulan_ini[0]->total ? $pembelian_bulan_ini[0]->total : 0;
        $total_bulan_sebelumnya = $pembelian_bulan_sebelumnya[0]->total ? $pembelian_bulan_sebelumnya[0]->total : 1;

        $perbandingan_total = ((($total_bulan_ini - $total_bulan_sebelumnya) / $total_bulan_sebelumnya) * (100/100));
        $perbandingan_total = number_format($perbandingan_total, 2);

        // ======================================================================
        // DATA UNTUK CHART PERFORMA PENJUALAN
        // ======================================================================
        $pendapatan_januari_tahun_ini = $this->getPembelian("$tahun_ini-01-01", "$tahun_ini-02-01");
        $pendapatan_januari_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-01-01", ($tahun_ini - 1) . "-02-01");

        $pendapatan_februari_tahun_ini = $this->getPembelian("$tahun_ini-02-01", "$tahun_ini-03-01");
        $pendapatan_februari_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-02-01", ($tahun_ini - 1) . "-03-01");

        $pendapatan_maret_tahun_ini = $this->getPembelian("$tahun_ini-03-01", "$tahun_ini-04-01");
        $pendapatan_maret_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-03-01", ($tahun_ini - 1) . "-04-01");

        $pendapatan_april_tahun_ini = $this->getPembelian("$tahun_ini-04-01", "$tahun_ini-05-01");
        $pendapatan_april_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-04-01", ($tahun_ini - 1) . "-05-01");

        $pendapatan_mei_tahun_ini = $this->getPembelian("$tahun_ini-05-01", "$tahun_ini-06-01");
        $pendapatan_mei_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-05-01", ($tahun_ini - 1) . "-06-01");

        $pendapatan_juni_tahun_ini = $this->getPembelian("$tahun_ini-06-01", "$tahun_ini-07-01");
        $pendapatan_juni_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-06-01", ($tahun_ini - 1) . "-07-01");

        $pendapatan_juli_tahun_ini = $this->getPembelian("$tahun_ini-07-01", "$tahun_ini-08-01");
        $pendapatan_juli_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-07-01", ($tahun_ini - 1) . "-08-01");

        $pendapatan_agustus_tahun_ini = $this->getPembelian("$tahun_ini-08-01", "$tahun_ini-09-01");
        $pendapatan_agustus_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-08-01", ($tahun_ini - 1) . "-09-01");

        $pendapatan_september_tahun_ini = $this->getPembelian("$tahun_ini-09-01", "$tahun_ini-10-01");
        $pendapatan_september_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-09-01", ($tahun_ini - 1) . "-10-01");

        $pendapatan_oktober_tahun_ini = $this->getPembelian("$tahun_ini-10-01", "$tahun_ini-11-01");
        $pendapatan_oktober_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-10-01", ($tahun_ini - 1) . "-11-01");

        $pendapatan_november_tahun_ini = $this->getPembelian("$tahun_ini-11-01", "$tahun_ini-12-01");
        $pendapatan_november_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-11-01", ($tahun_ini - 1) . "-12-01");

        $pendapatan_desember_tahun_ini = $this->getPembelian("$tahun_ini-12-01", "$tahun_ini-12-30");
        $pendapatan_desember_tahun_sebelumnya = $this->getPembelian(($tahun_ini - 1) . "-12-01", ($tahun_ini - 1) . "-12-30");
        
        return view('admin.dashboard', [
            'personelJabatan' => $this->checkPersonel(),
            
            'user' => $user,
            'jml_personel' => $jml_personel,
            'jml_paket' => $jml_paket,
            'jml_pelanggan' => $jml_pelanggan,
            'jml_pengiriman' => $jml_pengiriman,

            'number_of_visitors' => $number_of_visitors,

            'jml_pendaftar_dlm_tujuh_bulan' => $jml_pendaftar_dlm_tujuh_bulan,
            'jml_pembelian_dlm_tujuh_bulan' => $jml_pembelian_dlm_tujuh_bulan,
            'jml_pembayaran_dlm_tujuh_bulan' => $jml_pembayaran_dlm_tujuh_bulan,

            'pembelian_terbanyak' => $pembelian_terbanyak,

            'pendapatan_bulan_ini' => $pembelian_bulan_ini,
            'pendapatan_bulan_sebelumnya' => $pembelian_bulan_sebelumnya,
            'perbandingan_total' => $perbandingan_total,

            'pendapatan_januari_tahun_ini' => $pendapatan_januari_tahun_ini[0]->total,
            'pendapatan_januari_tahun_sebelumnya' => $pendapatan_januari_tahun_sebelumnya[0]->total,
            'pendapatan_februari_tahun_ini' => $pendapatan_februari_tahun_ini[0]->total,
            'pendapatan_februari_tahun_sebelumnya' => $pendapatan_februari_tahun_sebelumnya[0]->total,
            'pendapatan_maret_tahun_ini' => $pendapatan_maret_tahun_ini[0]->total,
            'pendapatan_maret_tahun_sebelumnya' => $pendapatan_maret_tahun_sebelumnya[0]->total,
            'pendapatan_april_tahun_ini' => $pendapatan_april_tahun_ini[0]->total,
            'pendapatan_april_tahun_sebelumnya' => $pendapatan_april_tahun_sebelumnya[0]->total,
            'pendapatan_mei_tahun_ini' => $pendapatan_mei_tahun_ini[0]->total,
            'pendapatan_mei_tahun_sebelumnya' => $pendapatan_mei_tahun_sebelumnya[0]->total,
            'pendapatan_juni_tahun_ini' => $pendapatan_juni_tahun_ini[0]->total,
            'pendapatan_juni_tahun_sebelumnya' => $pendapatan_juni_tahun_sebelumnya[0]->total,
            'pendapatan_juli_tahun_ini' => $pendapatan_juli_tahun_ini[0]->total,
            'pendapatan_juli_tahun_sebelumnya' => $pendapatan_juli_tahun_sebelumnya[0]->total,
            'pendapatan_agustus_tahun_ini' => $pendapatan_agustus_tahun_ini[0]->total,
            'pendapatan_agustus_tahun_sebelumnya' => $pendapatan_agustus_tahun_sebelumnya[0]->total,
            'pendapatan_september_tahun_ini' => $pendapatan_september_tahun_ini[0]->total,
            'pendapatan_september_tahun_sebelumnya' => $pendapatan_september_tahun_sebelumnya[0]->total,
            'pendapatan_oktober_tahun_ini' => $pendapatan_oktober_tahun_ini[0]->total,
            'pendapatan_oktober_tahun_sebelumnya' => $pendapatan_oktober_tahun_sebelumnya[0]->total,
            'pendapatan_november_tahun_ini' => $pendapatan_november_tahun_ini[0]->total,
            'pendapatan_november_tahun_sebelumnya' => $pendapatan_november_tahun_sebelumnya[0]->total,
            'pendapatan_desember_tahun_ini' => $pendapatan_desember_tahun_ini[0]->total,
            'pendapatan_desember_tahun_sebelumnya' => $pendapatan_desember_tahun_sebelumnya[0]->total,
        ]);
    }

    function getPembelian($waktu_pertama, $waktu_kedua) {
        return DB::select("
            SELECT SUM(paket.harga) AS total FROM pembelian JOIN paket ON paket.id = pembelian.id_paket
            WHERE NOT pembelian.status = 'Belum Bayar' AND NOT pembelian.status = 'Batal' AND pembelian.waktu_simpan BETWEEN ('$waktu_pertama 00:00:00') AND ('$waktu_kedua 00:00:00')
        ");
    }

    function getRingkasan($as, $from, $where, $tujuh_bulan_yang_lalu, $bulan_sekarang) {
        return DB::select("
            SELECT COUNT(id) AS $as FROM $from
            WHERE $where
        ")[0]->$as;
    }
}
