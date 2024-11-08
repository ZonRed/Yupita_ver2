<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'hari_jadwal',
        'buka_jadwal',
        'tutup_jadwal',
        'users_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
