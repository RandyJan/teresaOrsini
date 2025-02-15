<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historyLogs extends Model
{
    use HasFactory;
    protected $table = "history_logs";
    protected $fillable = [
        'pdate',
        'user_name',
        'activity',
        'room'
    ];

    public $timestamps = false;
}
