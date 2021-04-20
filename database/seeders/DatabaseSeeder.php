<?php

namespace Database\Seeders;

use App\Models\Boat;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Motorcycle;
use App\Models\Pet;
use App\Models\ShipmentStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** seed shipment statuses */
        $statuses = ShipmentStatus::getAvailableStatuses();

        foreach ($statuses as $id => $name) {
            ShipmentStatus::create([
                'id'   => $id,
                'name' => $name
            ]);
        }

        $category = Boat::create([
            'type' => 'yacht',
        ]);

        $category = Pet::create([
            'name'           => 'Pookie',
            'weight'         => 200,
            'race'           => 'Dalmation',
            'aggressiveness' => 1
        ]);

        $category = Motorcycle::create([
            'make'  => 'Suzuki',
            'model' => 'Turbo GTX',
            'year'  => 2012
        ]);

        $category = Car::create([
            'make'  => 'Mazda',
            'model' => '626',
            'year'  => 2019
        ]);

        Driver::create([
            'name' => 'Slavisa Perisic'
        ]);
        Driver::create([
            'name' => 'Bojan Matic'
        ]);
        Driver::create([
            'name' => 'Milos Miljkovic'
        ]);
    }
}
