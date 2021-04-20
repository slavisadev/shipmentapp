<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->date('pickup_date');

            $table->unsignedBigInteger('pickup_location_id');
            $table->foreign('pickup_location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->date('delivery_date');

            $table->unsignedBigInteger('delivery_location_id');
            $table->foreign('delivery_location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->text('description');
            $table->double('amount');

            $table->unsignedBigInteger('shipment_status_id');
            $table->foreign('shipment_status_id')->references('id')->on('shipment_statuses')->onDelete('cascade');

            $table->morphs('category');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
