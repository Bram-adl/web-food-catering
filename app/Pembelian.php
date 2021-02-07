<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use SoftDeletes;
    
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';

    protected $dates = ['waktu_hapus'];
    const DELETED_AT = 'waktu_hapus';

    protected $table = 'pembelian';
    protected $fillable = [
        'id_pelanggan', 'id_paket', 'kode_unik', 'lokasi',
        'bukti_bayar', 'status', 'lokasi', 'alamat',
        'waktu_pengiriman', 'tanggal_mulai', 'porsi'
    ];

    public function pelanggan()
    {
        return $this->belongsTo('App\Pelanggan', 'id_pelanggan');
    }

    public function paket()
    {
        return $this->belongsTo('App\Paket', 'id_paket');
    }
}
