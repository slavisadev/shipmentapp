<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasTimestamps;

    protected $fillable = ['id', 'name'];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
