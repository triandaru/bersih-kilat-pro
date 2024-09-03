<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Assume layanan IDs from 1 to 5 (as created in LayananSeeder)
        for ($i = 0; $i < 20; $i++) {
            $layananId = $faker->numberBetween(1, 5);

            DB::table('transaksis')->insert([
                'tanggal' => $faker->date(),
                'nama_pelanggan' => $faker->name,
                'no_kendaraan' => strtoupper($faker->lexify('??') . $faker->randomNumber(4, true)),
                'layanan' => $layananId,
                'total_biaya' => DB::table('layanans')->where('id_layanan', $layananId)->value('biaya'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
