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
        DB::statement("CREATE VIEW \"tbl_ikdt2\" AS  SELECT tbl_ikdt.iddetail,
    tbl_ikdt.notransaksi,
    tbl_ikdt.kodeitem,
    tbl_ikdt.dateupd,
    tbl_ikdt.harga,
    tbl_item.merek,
    tbl_ikhd.kodesupel,
    tbl_ikhd.kodesales,
    tbl_ikdt.total
   FROM ((tbl_ikdt
     JOIN tbl_ikhd USING (notransaksi))
     JOIN tbl_item ON (((tbl_item.kodeitem)::text = (tbl_ikdt.kodeitem)::text))),
     group by tbl_ikdt.notransaksi,tbl_ikdt.iddetail,
		tbl_ikdt.kodeitem,tbl_item.merek,tbl_ikdt.dateupd,
		tbl_ikdt.harga,tbl_ikhd.kodesupel,tbl_ikhd.kodesales,tbl_ikdt.total;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS \"tbl_ikdt2\"");
    }
};