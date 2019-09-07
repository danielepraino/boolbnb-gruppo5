<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Service;
use App\Flat;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create('it_IT');

      $newFlat = Flat::all();

      foreach ($newFlat as $flat) {
        $newService = new Service();
        $newService->wifi = $faker->numberBetween($min = 0, $max = 1);
        $newService->parking = $faker->numberBetween($min = 0, $max = 1);
        $newService->pool = $faker->numberBetween($min = 0, $max = 1);
        $newService->concierge = $faker->numberBetween($min = 0, $max = 1);
        $newService->sauna = $faker->numberBetween($min = 0, $max = 1);
        $newService->sea_view = $faker->numberBetween($min = 0, $max = 1);
        $newService->flat_id = $flat->id;
        $newService->save();
      }
    }
}
