<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // Primary key with custom name 'id_user'
            $table->string('nama_user');
            $table->string('username')->unique(); // Unique constraint on 'username'
            $table->string('password'); // Foreign key reference to Hak Akses table
            $table->unsignedBigInteger('akses');
            $table->timestamps(); // Automatically adds created_at and updated_at columns

            // Set foreign key constraint
            $table->foreign('akses')->references('id_akses')->on('hak_akses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
