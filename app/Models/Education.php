<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';
    protected $primaryKey = 'id_education';

    protected $fillable = [
        'user_id',
        'kualifikasi',
        'lembaga',
        'thnlulus',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


