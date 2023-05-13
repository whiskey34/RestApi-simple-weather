<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $table = 'weather_conditions';

    protected $fillable = ['location_id', 'temperature', 'humidity', 'wind_speed', 'description'];


    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
