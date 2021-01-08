<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use Notifiable;
    
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pelanggan';

    /**
     * Attributes that are mass-assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'wa',
        'rumah_teks', 'rumah_maps', 'rumah_kota', 'rumah_kecamatan', 'rumah_kelurahan',
        'kantor_teks', 'kantor_maps', 'kantor_kota', 'kantor_kecamatan', 'kantor_kelurahan',
        'keterangan', 'porsi',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
