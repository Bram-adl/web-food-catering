<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
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
