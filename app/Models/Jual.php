<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    use HasFactory;

    protected $table = 'jual';

    protected $fillable = [
        'tanggal_jual',
        'type_jual',
        'harga_jual',
        'stock_jual',
        'jumlah_jual',
        'users_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
