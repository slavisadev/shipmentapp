<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptBidRequest;
use App\Http\Requests\CreateBidRequest;
use App\Http\Requests\RetractBidRequest;
use App\Models\Bid;
use App\Models\Driver;
use App\Models\Shipment;
use App\Models\ShipmentStatus;

class BidController extends Controller
{
    /**
     * @param Shipment $shipment
     * @param CreateBidRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Shipment $shipment, CreateBidRequest $request)
    {
        if ($acceptedBidExists = $shipment->bids()->where('accepted', 1)->first()) {
            return response()->json('This shipment already has a winning bid (' . $acceptedBidExists->id . ')');
        }

        $driver = Driver::find($request->driver_id);

        if ($existingBid = $shipment->bids()->where('driver_id', $driver->id)->first()) {
            return response()->json('This driver has already made his bid.  (' . $existingBid->id . ')');
        }

        Bid::create([
            'shipment_id' => $shipment->id,
            'driver_id'   => $driver->id,
            'amount'      => $request->amount
        ]);

        return response()->json($shipment->bids);
    }

    /**
     * @param Shipment $shipment
     * @param RetractBidRequest $request
     *
     * @return bool|mixed|null
     */
    public function retract(Shipment $shipment, RetractBidRequest $request)
    {
        $existingBid = $shipment->bids()->where('driver_id', $request->driver_id)->first();

        if (!$existingBid) {
            return response()->json('This driver has no existing bid for this shipment', 500);
        }

        return $existingBid->delete();
    }

    /**
     * @param Shipment $shipment
     * @param AcceptBidRequest $request
     *
     * @return bool|mixed|null
     */
    public function accept(Shipment $shipment, AcceptBidRequest $request)
    {
        $existingBid = $shipment->bids()->where('driver_id', $request->driver_id)->first();

        if (!$existingBid) {
            return response()->json('This driver has no existing bid for this shipment', 500);
        }

        if ($shipment->shipmentStatus->id === ShipmentStatus::SHIPMENT_STATUS_BOOKED) {
            return response()->json('This shipment has already been booked', 500);
        }

        $existingBid->accepted = 1;
        $existingBid->save();
        return response()->json('The bid (' . $existingBid->id . ') has been accepted. Shipment is now booked.');
    }
}
