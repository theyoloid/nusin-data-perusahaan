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
        DB::statement("CREATE VIEW \"tbl_piutang\" AS  SELECT tbl_byrpiutangdt.iddetail,
    tbl_byrpiutanghd.notransaksi,
    tbl_byrpiutangdt.notrsmasuk,
    tbl_byrpiutanghd.totalbayar,
    tbl_byrpiutanghd.kodesupel,
    tbl_ikhd.kodesales,
    tbl_byrpiutanghd.totalpotongan,
    tbl_byrpiutanghd.tanggal,
    tbl_byrpiutanghd.dateupd,
    tbl_ikdt1.merek,
    (tbl_byrpiutanghd.totalbayar - tbl_byrpiutanghd.totalpotongan) AS piutang
   FROM (((tbl_byrpiutanghd
     JOIN tbl_byrpiutangdt USING (notransaksi))
     JOIN tbl_ikhd ON (((tbl_ikhd.notransaksi)::text = (tbl_byrpiutangdt.notrsmasuk)::text)))
     JOIN tbl_ikdt1 ON (((tbl_ikdt1.notransaksi)::text = (tbl_byrpiutangdt.notrsmasuk)::text)))
  GROUP BY tbl_byrpiutanghd.notransaksi, tbl_byrpiutangdt.iddetail, tbl_byrpiutangdt.notrsmasuk, tbl_ikhd.kodesales, tbl_ikdt1.merek;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS \"tbl_piutang\"");
    }
};