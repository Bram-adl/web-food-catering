<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';
    
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
    protected $fillables = [
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
