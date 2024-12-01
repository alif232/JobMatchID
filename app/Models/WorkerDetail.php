<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerDetail extends Model
{
    use HasFactory;

    // Nama tabel yang sesuai dengan database
    protected $table = 'user_detail_worker';

    // Kolom yang dapat diisi (Mass Assignment)
    protected $fillable = [
        'user_id',
        'nama',
        'tgllahir',
        'alamat',
        'logo_photo',
        'notelp',
        'deskripsi',
        'link'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
