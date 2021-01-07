<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personel extends Model
{
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'id_jabatan',
        'nik', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'wa', 'alamat', 'id_kota', 'id_kecamatan', 'id_kelurahan',
        'foto'
    ];
    
    /**
     * Get the Personel that owns the Jabatan.
     */
    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan', 'id_jabatan');
    }
}
