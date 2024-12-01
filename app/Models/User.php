<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = [
        'email', 'password', 'level',
    ];

    public function companyDetail()
    {
        return $this->hasOne(CompanyDetail::class, 'user_id');
    }

    public function workerDetail()
    {
        return $this->hasOne(WorkerDetail::class, 'user_id');
    }
}





