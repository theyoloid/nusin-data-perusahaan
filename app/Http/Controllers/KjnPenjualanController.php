<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KjnPenjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class KjnPenjualanController extends Controller
{
    public function index(Request $request) {
        $searchitem = $request->searchitem;
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;
        
        $plis = KjnPenjualan::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        //Hasil Filter untuk Penjualan
        if (empty($searchsales)) {
            $results =  DB::connection('pgsql3')->table('tbl_penjualan')
            ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
            ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->select('merek', DB::raw('SUM(total) AS total_penjualan'))
            ->whereBetween('dateupd', [$start, $end])
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
        } else {
            $results =  DB::connection('pgsql3')->table('tbl_penjualan')
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
            ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->select('merek', DB::raw('SUM(total) AS total_penjualan'))
            ->whereBetween('dateupd', [$start, $end])
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get()
            ;
        } 
        
        return view('penjualan', [
            'divisinya' => 'Kjn',
            'dataPenjualan' => $plis,
            'filter' => $results,
        ]);
}

    public function exportPdf(Request $request) {
        $searchitem = $request->searchitem;
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 10000000;

        $plis = KjnPenjualan::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);

        //Hasil Filter untuk Penjualan
        if (empty($searchsales)) {
            $results =  DB::connection('pgsql3')->table('tbl_penjualan')
            ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
            ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->select('merek', DB::raw('SUM(total) AS total_penjualan'))
            ->whereBetween('dateupd', [$start, $end])
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
        } else {
            $results =  DB::connection('pgsql3')->table('tbl_penjualan')
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
            ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->select('merek', DB::raw('SUM(total) AS total_penjualan'))
            ->whereBetween('dateupd', [$start, $end])
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get()
            ;
        } 
        
        
        $pdf = Pdf::loadView('pdf.export-penjualan', [
            'dataPenjualan' => $plis,
            'divisinya' => 'Kjn',
            'filter' => $results,
        ]);
        return $pdf->download('KjnPenjualan-'.Carbon::now()->timestamp.'.pdf');
    }
}