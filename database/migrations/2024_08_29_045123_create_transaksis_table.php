<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi'); // Primary key with custom name 'id_transaksi'
            $table->date('tanggal'); // Date type for 'tanggal'
            $table->string('nama_pelanggan');
            $table->string('no_kendaraan');
            $table->unsignedBigInteger('layanan'); // Foreign key reference to layanan table
            $table->decimal('total_biaya', 10, 2); // Total biaya with decimal type
            $table->timestamps(); // Automatically adds created_at and updated_at columns

            // Set foreign key constraint
            $table->foreign('layanan')->references('id_layanan')->on('layanans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
