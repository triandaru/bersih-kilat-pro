<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $aksesId = $faker->numberBetween(1, 2);
            DB::table('users')->insert([
                'nama_user' => $faker->name,
                'username' => $faker->unique()->userName,
                'password' => Hash::make('password'), // Using a default password for all users
                'akses' => $aksesId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
