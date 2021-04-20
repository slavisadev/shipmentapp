<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasTimestamps;

    protected $fillable = ['type'];

    public static $availableTypes = [
        'sail boat',
        'yacht',
        'jet ski',
        'power boat'
    ];

    public function shipments()
    {
        return $this->morphMany(Shipment::class, 'category');
    }
}
