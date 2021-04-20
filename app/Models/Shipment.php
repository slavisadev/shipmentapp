<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Shipment extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'category_id',
        'category_type',
        'pickup_location_id',
        'delivery_location_id',
        'pickup_date',
        'delivery_date',
        'shipment_status_id',
        'description',
        'amount'
    ];

    public function category()
    {
        return $this->morphTo();
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function deliveryLocation()
    {
        return $this->belongsTo(Location::class, 'delivery_location_id');
    }

    public function shipmentStatus()
    {
        return $this->belongsTo(ShipmentStatus::class, 'shipment_status_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function updateStatus($newStatus)
    {
        if (
            $this->shipmentStatus->id === ShipmentStatus::SHIPMENT_STATUS_POSTED
            &&
            $newStatus === ShipmentStatus::SHIPMENT_STATUS_BOOKED
        ) {
            $this->shipment_status_id = $newStatus;
            $this->save();
        }
    }
}
