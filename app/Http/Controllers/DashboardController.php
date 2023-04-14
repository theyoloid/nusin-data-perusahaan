<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //index

    public function index(Request $request) {
        $name = 'Admin';
        $searchitem = $request->searchitem;
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;

        
        // Penjualan Test
        $testpenjualan = DB::connection('pgsql')
        ->table('tbl_ikdt2')
        ->select('merek', 
        DB::raw("('Rp. ' || trim(to_char(SUM(total), 'FM999G999G999D00'), '0')) as total_penjualan_idr")) 
        ->whereBetween('dateupd', [$start , $end])
        ->where('merek', 'LIKE', '%' .$searchmerek. '%')
        ->groupBy('merek')
        ->orderBy('merek', 'asc')
        ->get();
        
        
        return view('dashboard', 
        [
            'nama' => $name,
            'testPenjualan' => $testpenjualan,
        ]);
    }
}