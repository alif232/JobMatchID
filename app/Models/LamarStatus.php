<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LamarStatus extends Model
{
    use HasFactory;

    protected $table = 'lamar_status';
    protected $primaryKey = 'id_status';

    protected $fillable = [
        'id_user',
        'id_lamar',
        'status',
        'note',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Lamar
    public function lamar()
    {
        return $this->belongsTo(Pelamar::class, 'id_lamar');
    }
}