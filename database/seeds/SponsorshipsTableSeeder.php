<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Sponsorship;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create('it_IT');

      for ($i=0; $i < 10; $i++) {
        $newSponsorship = new Sponsorship();
        $newSponsorship->duration = $faker->randomElement($array = array (24, 72, 144));
        $newSponsorship->price = $faker->randomElement($array = array (3, 6, 10));
        $newSponsorship->flat_id = $faker->numberBetween($min = 1, $max = 10);
        $newSponsorship->sponsorships_expires = $faker->dateTime();
        $newSponsorship->save();
      }
    }
}
