<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $primaryKey = 'id_jobs';

    protected $fillable = [
        'id_user',
        'posisi',
        'kualifikasi',
        'jobdesk',
        'benefit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function pelamars()
    {
        return $this->hasMany(Pelamar::class, 'id_jobs'); // Relasi dengan Pelamar
    }

    public function workerDetail()
    {
        return $this->belongsTo(WorkerDetail::class, 'id_user', 'user_id'); // Relasi dengan Pelamar
    }
}