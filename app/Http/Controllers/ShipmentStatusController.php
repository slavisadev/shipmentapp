<?php

namespace App\Http\Controllers;

use App\Models\ShipmentStatus;
use Illuminate\Http\Request;

class ShipmentStatusController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(ShipmentStatus::all());
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
        return ShipmentStatus::create($request->all());
    }

    /**
     * @param ShipmentStatus $shipmentStatus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ShipmentStatus $shipmentStatus)
    {
        return response()->json($shipmentStatus);
    }

    /**
     * @param Request $request
     * @param ShipmentStatus $shipmentStatus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, ShipmentStatus $shipmentStatus)
    {
        return response()->json($shipmentStatus->update($request->all()));
    }

    /**
     * @param ShipmentStatus $shipmentStatus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ShipmentStatus $shipmentStatus)
    {
        return response()->json($shipmentStatus->delete());
    }
}
