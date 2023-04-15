<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->string('userid', 20)->primary();
            $table->string('nama', 150)->nullable();
            $table->string('password')->nullable();
            $table->string('tipe', 5)->nullable();
            $table->string('loginkantor', 50)->nullable();
            $table->string('kelompok', 35)->nullable();
            $table->boolean('loginshift')->nullable();
            $table->boolean('synchronized')->nullable()->comment('apakah mobile user sudah dipakai atau belum');
            $table->string('kodesales', 50)->nullable();
            $table->boolean('stslogin')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user');
    }
};
