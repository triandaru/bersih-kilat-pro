<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hak_akses')->insert([
            ['nama_akses' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['nama_akses' => 'User', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
