<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions_kasir'; // Nama tabel

    protected $fillable = [
        'item_kasir',
        'jumlah_kasir',
        'total_kasir',
        'pembayaran_kasir',
        'kembalian_kasir',
        'user_id'
    ]; // Kolom yang dapat diisi

    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke model User
    }
}
