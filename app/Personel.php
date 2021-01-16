<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Personel extends Authenticatable
{
    use Notifiable, SoftDeletes;
    
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';

    protected $dates = ['waktu_hapus'];
    const DELETED_AT = 'waktu_hapus';
    
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    
    /**
     * Get the Personel that owns the Jabatan.
     */
    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan', 'id_jabatan');
    }
}
