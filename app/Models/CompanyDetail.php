<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $table = 'user_detail_company'; // Specify the table name if it doesn't follow naming conventions

    protected $fillable = [
        'user_id', 'company_name', 'company_address', 'logo_photo',
        'phone_number', 'email', 'description',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}