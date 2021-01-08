<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';

    protected $table = 'pembelian';
    protected $fillable = [
        'id_pelanggan', 'id_paket', 'kode_unik',
        'bukti_bayar', 'status'
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
