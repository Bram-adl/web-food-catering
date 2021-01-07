<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jabatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jabatan', 'keterangan',
    ];

    /**
     * Get the personel record associated with the jabatan.
     */
    public function personel()
    {
        return $this->hasOne('App\Personel', 'id_jabatan');
    }
}
