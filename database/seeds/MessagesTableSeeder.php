<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Message;

class MessagesTableSeeder extends Seeder
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
        $newMessage = new Message();
        $newMessage->sender = $faker->safeEmail;
        $newMessage->subject = $faker->sentence($nbWords = 6, $variableNbWords = true);
        $newMessage->message = $faker->text($maxNbChars = 200);
        $newMessage->flat_id = $faker->numberBetween($min = 1, $max = 10);
        $newMessage->save();
      }
    }
}
