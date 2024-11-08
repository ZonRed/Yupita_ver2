<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promos';

    protected $fillable = [
        'tanggal_mulai_promo',
        'tanggal_akhir_promo',
        'type_promo',
        'info_promo',
        'harga_promo',
        'users_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
