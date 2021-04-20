<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class PimpMyRide extends Model
{
    use HasTimestamps;

    protected $fillable = ['make', 'model', 'year'];

    public function shipments()
    {
        return $this->morphMany(Shipment::class, 'category');
    }

}
