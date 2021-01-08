<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    const CREATED_AT = 'waktu_simpan';
    const UPDATED_AT = 'waktu_edit';
    
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
}
