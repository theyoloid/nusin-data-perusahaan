<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //index

    public function index(Request $request) {
        $name = 'Admin';
        $start = $request->start;
        $end = $request->end;
        
        // JATIM
        // Penjualan 
        $jatimPenjualan = DB::connection('pgsql1')
        ->table('tbl_ikdt2')
        ->select('merek', 
        DB::raw("('Rp. ' || trim(to_char(SUM(total), 'FM999G999G999D00'), '0')) as total_penjualan_idr")) 
        ->whereBetween('dateupd', [$start , $end])
        ->groupBy('merek')
        ->orderBy('merek', 'asc')
        ->get();

        //Laba 
        $jatimLaba = DB::connection('pgsql1')->table('tbl_laba_new')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(laba), 'FM999G999G999D00')) as total_laba")) 
            ->whereBetween('dateupd', [$start, $end])
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();

        // Piutang 
        $jatimPiutang = DB::connection('pgsql1')->table('tbl_piutang')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(piutang), 'FM999G999G999D00')) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        // DANIEL
        // Penjualan 
        $danielPenjualan = DB::connection('pgsql2')
        ->table('tbl_ikdt2')
        ->select('merek', 
        DB::raw("('Rp. ' || trim(to_char(SUM(total), 'FM999G999G999D00'), '0')) as total_penjualan_idr")) 
        ->whereBetween('dateupd', [$start , $end])
        ->groupBy('merek')
        ->orderBy('merek', 'asc')
        ->get();

        //Laba 
        $danielLaba = DB::connection('pgsql2')->table('tbl_laba_new')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(laba), 'FM999G999G999D00')) as total_laba")) 
            ->whereBetween('dateupd', [$start, $end])
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();

        // Piutang 
        $danielPiutang = DB::connection('pgsql2')->table('tbl_piutang')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(piutang), 'FM999G999G999D00')) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        // KJN
        // Penjualan 
        $kjnPenjualan = DB::connection('pgsql3')
        ->table('tbl_ikdt2')
        ->select('merek', 
        DB::raw("('Rp. ' || trim(to_char(SUM(total), 'FM999G999G999D00'), '0')) as total_penjualan_idr")) 
        ->whereBetween('dateupd', [$start , $end])
        ->groupBy('merek')
        ->orderBy('merek', 'asc')
        ->get();

        //Laba 
        $kjnLaba = DB::connection('pgsql3')->table('tbl_laba_new')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(laba), 'FM999G999G999D00')) as total_laba")) 
            ->whereBetween('dateupd', [$start, $end])
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();

        // Piutang 
        $kjnPiutang = DB::connection('pgsql3')->table('tbl_piutang')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(piutang), 'FM999G999G999D00')) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        
        return view('dashboard', 
        [
            'nama' => $name,
            // JATIM
            'jatimPenjualan' => $jatimPenjualan,
            'jatimLaba' => $jatimLaba,
            'jatimPiutang' => $jatimPiutang,
            // DANIEL
            'danielPenjualan' => $danielPenjualan,
            'danielLaba' => $danielLaba,
            'danielPiutang' => $danielPiutang,
            // KJN
            'kjnPenjualan' => $kjnPenjualan,
            'kjnLaba' => $kjnLaba,
            'kjnPiutang' => $kjnPiutang,
        ]);
    }
}