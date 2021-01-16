<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
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
    protected $table = 'kategori';

    /**
     * Properties that are mass-assignable
     * 
     * @var array
     */
    protected $fillable = [
        'kategori', 'keterangan',
    ];

    /**
     * Get the paket record associated with the kategori
     */
    public function paket()
    {
        return $this->hasOne('App\Paket', 'id_kategori');
    }
}
