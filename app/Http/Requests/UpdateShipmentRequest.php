<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'          => 'required', //todo: if I had time, I would have created a custom validator for polymorphic models
            'category_type'        => 'required|in:App\Models\Car,App\Models\Boat,App\Models\Pet,App\Models\Motorcycle',
            'pickup_location_id'   => 'required|exists:locations,id',
            'pickup_date'          => 'date',
            'delivery_location_id' => 'required|exists:locations,id',
            'delivery_date'        => 'date',
            'shipment_status_id'   => 'required|exists:shipment_statuses,id|in:3,4',
            'description'          => 'required',
            'amount'               => 'numeric',
        ];
    }
}
