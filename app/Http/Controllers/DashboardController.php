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
        $searchsales = $request->searchsales;
        
        // JATIM
        // Penjualan 
        if (empty($searchsales)) {  
            $jatimPenjualan = DB::connection('pgsql1')
                ->table('tbl_ikdt2')
                ->select('merek', 
                DB::raw("CAST(SUM(total) AS FLOAT) as total_penjualan"))
                ->whereBetween('dateupd', [$start , $end])
                // ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->groupBy('merek')
                ->orderBy('merek', 'asc')
                ->get();
            }  else {
            $jatimPenjualan = DB::connection('pgsql1')
                ->table('tbl_ikdt2')
                ->select('merek', 
                DB::raw("CAST(SUM(total) AS FLOAT) as total_penjualan"))
                ->whereBetween('dateupd', [$start , $end])
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->groupBy('merek')
                ->orderBy('merek', 'asc')
                ->get();
            
        }

        //Laba 
        if(empty($searchsales)){
            $jatimLaba = DB::connection('pgsql1')->table('tbl_laba_new')
                    ->select('merek', 
                    DB::raw("CAST(SUM(laba) AS FLOAT) as total_laba"))
                    ->whereBetween('dateupd', [$start, $end])
                    ->groupBy('merek')
                    ->orderBy('merek', 'asc')
                    ->get();
        } else {
            $jatimLaba = [];
        }


        // Piutang 
        $jatimPiutang = DB::connection('pgsql1')->table('tbl_piutang')
            ->select('merek', 
            DB::raw("CAST(SUM(piutang) AS FLOAT) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        // DANIEL
        // Penjualan 
        if (empty($searchsales)) {  
            $danielPenjualan = DB::connection('pgsql2')
                ->table('tbl_ikdt2')
                ->select('merek', 
                DB::raw("CAST(SUM(total) AS FLOAT) as total_penjualan"))
                ->whereBetween('dateupd', [$start , $end])
                // ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->groupBy('merek')
                ->orderBy('merek', 'asc')
                ->get();
            }  else {
            $danielPenjualan = DB::connection('pgsql2')
                ->table('tbl_ikdt2')
                ->select('merek', 
                DB::raw("CAST(SUM(total) AS FLOAT) as total_penjualan"))
                ->whereBetween('dateupd', [$start , $end])
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->groupBy('merek')
                ->orderBy('merek', 'asc')
                ->get();
            
        }

        //Laba 
        if(empty($searchsales)){
            $danielLaba = DB::connection('pgsql2')->table('tbl_laba_new')
                    ->select('merek', 
                    DB::raw("CAST(SUM(laba) AS FLOAT) as total_laba"))
                    ->whereBetween('dateupd', [$start, $end])
                    ->groupBy('merek')
                    ->orderBy('merek', 'asc')
                    ->get();
        } else {
            $danielLaba = [];
        }

        // Piutang 
        $danielPiutang = DB::connection('pgsql2')->table('tbl_piutang')
            ->select('merek', 
            DB::raw("CAST(SUM(piutang) AS FLOAT) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        // KJN
        // Penjualan 
        if (empty($searchsales)) {  
            $kjnPenjualan = DB::connection('pgsql3')
                ->table('tbl_ikdt2')
                ->select('merek', 
                DB::raw("CAST(SUM(total) AS FLOAT) as total_penjualan"))
                ->whereBetween('dateupd', [$start , $end])
                // ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->groupBy('merek')
                ->orderBy('merek', 'asc')
                ->get();
            }  else {
            $kjnPenjualan = DB::connection('pgsql3')
                ->table('tbl_ikdt2')
                ->select('merek', 
                DB::raw("CAST(SUM(total) AS FLOAT) as total_penjualan"))
                ->whereBetween('dateupd', [$start , $end])
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->groupBy('merek')
                ->orderBy('merek', 'asc')
                ->get();
            
        }

        //Laba 
        if(empty($searchsales)){
            $kjnLaba = DB::connection('pgsql3')->table('tbl_laba_new')
                    ->select('merek', 
                    DB::raw("CAST(SUM(laba) AS FLOAT) as total_laba"))
                    ->whereBetween('dateupd', [$start, $end])
                    ->groupBy('merek')
                    ->orderBy('merek', 'asc')
                    ->get();
        } else {
            $kjnLaba = [];
        }

        // Piutang 
        $kjnPiutang = DB::connection('pgsql3')->table('tbl_piutang')
            ->select('merek', 
            DB::raw("CAST(SUM(piutang) AS FLOAT) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
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