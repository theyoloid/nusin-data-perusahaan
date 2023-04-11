<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW \"tbl_merk\" AS  SELECT tbl_ikdt.kodeitem,
    tbl_ikdt.notransaksi,
    tbl_ikdt.iddetail,
    tbl_item.merek
   FROM (tbl_ikdt
     JOIN tbl_item USING (kodeitem));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS \"tbl_merk\"");
    }
};
