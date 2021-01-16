<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
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
    protected $table = 'paket';

    /**
     * Properties that are mass-assignable
     * 
     * @var array
     */
    protected $fillable = [
        'paket', 'porsi', 'id_kategori', 'foto', 'harga', 'pagi', 'siang', 'sore',
    ];

    /**
     * Get the kategori record associated with the paket
     */
    public function kategori() {
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }

    public function pembelian()
    {
        return $this->hasOne('App\Pembelian', 'id_paket');
    }
}
