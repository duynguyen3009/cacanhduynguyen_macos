<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Model
{
    use HasFactory;

    protected $table = 'user';

    protected $fillable = [
        'id', 
        'email', 
        'password', 
        'first_name', 
        'last_name',
        'city',
        'address',
        'phone_number',
        'role',
        'status',
        'sequence',
    ];
}
