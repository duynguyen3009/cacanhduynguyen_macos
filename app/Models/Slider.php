<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $fillable = ['id', 'image', 'name', 'url', 'description' ,'status', 'sequence', 'start_date', 'end_date'];

    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Carbon\Carbon::parse($value)->format(config('params.format_date')),
            set: fn (string $value) => \Carbon\Carbon::createFromFormat(config('params.format_date'), $value)->format(config('params.format_date_to_db')),

        );
    }
    
    protected function endDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Carbon\Carbon::parse($value)->format(config('params.format_date')),
            set: fn (string $value) => \Carbon\Carbon::createFromFormat(config('params.format_date'), $value)->format(config('params.format_date_to_db')),
        );
    }
}
