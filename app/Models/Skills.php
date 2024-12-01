<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $table = 'Skills';
    protected $primaryKey = 'id_skills';

    protected $fillable = [
        'user_id',
        'skills',
    ];
}
