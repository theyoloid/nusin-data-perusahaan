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
        Schema::create('tbl_laba_new', function (Blueprint $table) {
            $table->timestamps();
            $table->string('iddetail', 150)->nullable();
            $table->string('notransaksi', 100)->nullable();
            $table->string('kodeitem', 100)->nullable();
            $table->decimal('jumlahdasar', 20, 3)->nullable();
            $table->decimal('hargadasar', 35, 20)->nullable();
            $table->decimal('total', 20, 3)->nullable();
            $table->date('dateupd')->nullable();
            $table->string('merek', 50)->nullable();
            $table->decimal('laba', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_laba_new');
    }
};