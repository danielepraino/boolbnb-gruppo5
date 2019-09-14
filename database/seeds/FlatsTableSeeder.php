<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Flat;

class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create('it_IT');
      for ($i=0; $i < 100; $i++) {
        $newFlat = new Flat();
        $newFlat->title = $faker->sentence($nbWords = 6, $variableNbWords = true);
        $newFlat->description = $faker->text($maxNbChars = 200);
        $newFlat->room = $faker->numberBetween($min = 1, $max = 6);
        $newFlat->bed = $faker->numberBetween($min = 2, $max = 6);
        $newFlat->bathroom = $faker->numberBetween($min = 1, $max = 2);
        $newFlat->sm = $faker->numberBetween($min = 60, $max = 200);
        $newFlat->address = $faker->address;
        $newFlat->visible = $faker->numberBetween($min = 0, $max = 1);
        $newFlat->lon = $faker->longitude($min = 8.5, $max = 9.7);
        $newFlat->lat = $faker->latitude($min = 45.3, $max = 45.9);
        $newFlat->price = $faker->numberBetween($min = 50, $max = 300);
        $newFlat->user_id = $faker->numberBetween($min = 1, $max = 10);
        $newFlat->save();
      }
    }
}
