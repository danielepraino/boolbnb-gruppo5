<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsersTableSeeder extends Seeder
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
          $newUser = new User();
          $newUser->name = $faker->firstName;
          $newUser->surname = $faker->lastName;
          $newUser->birthdate = $faker->date($format = 'd-m-Y', $max = '01-01-2001');
          $newUser->email = $faker->safeEmail;
          $newUser->password = '$2y$10$vLD2qTIxObGRDdmrNwkaa.PHaj5r0di1RRiJAtP33IJwvOabx6p.O';
          $newUser->save();
        }
    }
}
