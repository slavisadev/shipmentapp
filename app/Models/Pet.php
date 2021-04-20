<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasTimestamps;

    protected $fillable = ['name', 'weight', 'race', 'aggressiveness'];

    public function shipments()
    {
        return $this->morphMany(Shipment::class, 'category');
    }

}
