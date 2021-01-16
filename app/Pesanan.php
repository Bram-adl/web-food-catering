<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesanan extends Model
{
    use SoftDeletes;
    
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';

    protected $dates = ['waktu_hapus'];
    const DELETED_AT = 'waktu_hapus';
    
    protected $table = 'pesanan';

    protected $fillable = [
        'id_pembelian', 'tanggal_kirim', 'waktu_kirim', 'alamat', 'porsi',
        'catatan_pelanggan', 'catatan_kurir',
    ];
}
