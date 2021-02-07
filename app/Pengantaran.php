<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengantaran extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';

    protected $dates = ['waktu_hapus'];
    const DELETED_AT = 'waktu_hapus';

    protected $table = 'pengantaran';

    protected $fillable = [
        'id_pesanan', 'keterangan', 'id_personel'
    ];
}
