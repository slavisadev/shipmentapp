<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Location;
use App\Models\Shipment;
use App\Models\ShipmentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class ShipmentController
 *
 * @package App\Http\Controllers
 */
class ShipmentController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Shipment::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $pickupLocation = Location::where('city', $request->pickup_city)->first();
            if (!$pickupLocation) {
                $pickupLocation = Location::create([
                    'city'  => $request->pickup_city,
                    'state' => 'Alabama',
                ]);
            }

            $deliveryLocation = Location::where('city', $request->delivery_city)->first();
            if (!$deliveryLocation) {
                $deliveryLocation = Location::create([
                    'city'  => $request->delivery_city,
                    'state' => 'Alabama',
                ]);
            }

            $shipmentStatus = ShipmentStatus::where('id', ShipmentStatus::SHIPMENT_STATUS_POSTED)->first();

            $shipment = Shipment::create([
                'category_id'          => $request->category_id,
                'category_type'        => $request->category_type,
                'pickup_location_id'   => $pickupLocation->id,
                'pickup_date'          => $request->pickup_date,
                'delivery_date'        => $request->delivery_date,
                'delivery_location_id' => $deliveryLocation->id,
                'shipment_status_id'   => $shipmentStatus->id,
                'description'          => $request->description,
                'amount'               => $request->amount,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            $shipment = false;
            Log::error($e->getMessage());
            Log::error($e->getFile());
            Log::error($e->getLine());
            DB::rollBack();
        }

        return $shipment;
    }

    /**
     * @param Shipment $shipment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Shipment $shipment)
    {
        return response()->json($shipment);
    }

    /**
     * @param Request $request
     * @param Shipment $shipment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment)
    {
        if ($shipment->shipmentStatus->id === ShipmentStatus::SHIPMENT_STATUS_BOOKED) {
            return response()->json('Editing of this shipment is disabled due to its state', 500);
        }

        $data = $request->all();

        return response()->json($shipment->update($data));
    }
}
