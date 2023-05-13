<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    use HasFactory;

    protected $table = 'weather_forecast';

    protected $fillable = [
        'location_id',
        'date',
        'min_temperature',
        'max_temperature',
        'humidity',
        'wind_speed',
        'description'

    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
