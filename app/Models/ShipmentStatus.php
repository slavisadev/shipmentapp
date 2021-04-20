<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class ShipmentStatus extends Model
{
    use HasTimestamps;

    protected static $statuses = [
        self::SHIPMENT_STATUS_POSTED    => 'Posted',
        self::SHIPMENT_STATUS_BOOKED    => 'Booked',
        self::SHIPMENT_STATUS_DELIVERED => 'Delivered',
        self::SHIPMENT_STATUS_ABORTED   => 'Aborted',
        self::SHIPMENT_STATUS_DELETED   => 'Deleted'
    ];
    const SHIPMENT_STATUS_POSTED = 1;
    const SHIPMENT_STATUS_BOOKED = 2;
    const SHIPMENT_STATUS_DELIVERED = 3;
    const SHIPMENT_STATUS_ABORTED = 4;
    const SHIPMENT_STATUS_DELETED = 5;
    protected $fillable = ['id', 'name'];

    public static function getAvailableStatuses()
    {
        return self::$statuses;
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
