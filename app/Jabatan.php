<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;
    
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';

    protected $dates = ['waktu_hapus'];
    const DELETED_AT = 'waktu_hapus';
    
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
        'jabatan', 'keterangan', 'warna',
    ];

    /**
     * Get the personel record associated with the jabatan.
     */
    public function personel()
    {
        return $this->hasOne('App\Personel', 'id_jabatan');
    }
}
