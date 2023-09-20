<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';

    protected $fillable = ['logo', 'company_name','phone_number','address','email','consulation_time','link_facebook','link_youtube','link_tiktok','link_googlemap'];

}
