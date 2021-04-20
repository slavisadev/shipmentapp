<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Driver::all());
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
        return Driver::create($request->all());
    }

    /**
     * @param Driver $driver
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Driver $driver)
    {
        return response()->json($driver);
    }

    /**
     * @param Request $request
     * @param Driver $driver
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Driver $driver)
    {
        return response()->json($driver->update($request->all()));
    }

    /**
     * @param Driver $driver
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Driver $driver)
    {
        return response()->json($driver->delete());
    }
}
