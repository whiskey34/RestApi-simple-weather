<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];

    public function weather()
    {
        return $this->hasMany(Weather::class);
    }
}
