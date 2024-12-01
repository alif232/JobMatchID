<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $table = 'lamar';
    protected $primaryKey = 'id_lamar';

    protected $fillable = [
        'id_user',
        'id_jobs',
        'cv',
        'link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'id_jobs', 'id_jobs'); // Relasi dengan Job
    }

    public function status()
    {
        return $this->hasMany(LamarStatus::class, 'id_lamar', 'id_lamar'); // Relasi dengan Job
    }

    public function workerDetail()
    {
        return $this->belongsTo(WorkerDetail::class, 'id_user', 'user_id');
    }
}
