<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Bid extends Model
{
    use HasTimestamps, SoftDeletes;

    protected $fillable = [
        'shipment_id',
        'driver_id',
        'amount',
        'accepted'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function ($bid) {
            Log::error($bid->accepted);
            if ($bid->accepted) {
                $bid->shipment->updateStatus(ShipmentStatus::SHIPMENT_STATUS_BOOKED);
            }
        });
    }
}
