<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'city',
        'state',
        'zip_code',
        'address',
        'latitude',
        'latitude',
    ];
}
