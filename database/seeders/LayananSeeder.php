<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('layanans')->insert([
            [
                'nama_layanan' => 'Cuci Mobil',
                'biaya' => 50000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Cuci Motor',
                'biaya' => 25000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Cuci Karpet',
                'biaya' => 150000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Balancing',
                'biaya' => 75000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Cuci Kasur',
                'biaya' => 200000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
