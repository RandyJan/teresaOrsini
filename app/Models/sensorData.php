<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sensorData extends Model
{
    use HasFactory;
    protected $table = 'sensorData';
    protected $fillable = [
        'room',
        'humidity',
        'temperature',
        'smoke',
        'motion',
    ];
    public $timestamps = false;
}
