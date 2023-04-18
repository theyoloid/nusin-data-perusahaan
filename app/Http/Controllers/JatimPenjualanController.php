<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\JatimPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class JatimPenjualanController extends Controller
{
    public function index(Request $request) {
        $searchitem = $request->searchitem;
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;
        
        $plis = JatimPenjualan::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);

        //Hasil Filter untuk Penjualan
        $results =  DB::connection('pgsql1')->table('tbl_penjualan')
            ->select('merek', DB::raw('SUM(total) AS total_penjualan'))
            ->whereBetween('dateupd', [$start, $end])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
            ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
        
        return view('penjualan', [
            'divisinya' => 'Jatim',
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

        $plis = JatimPenjualan::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);

        //Hasil Filter 
        $results =  DB::connection('pgsql1')->table('tbl_penjualan')
            ->select('merek', DB::raw('SUM(total) AS total_penjualan'))
            ->whereBetween('dateupd', [$start, $end])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
            ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
        
        $pdf = Pdf::loadView('pdf.export-penjualan', [
            'dataPenjualan' => $plis,
            'divisinya' => 'Jatim',
            'filter'=> $results,
        ]);
        return $pdf->download('JatimPenjualan-'.Carbon::now()->timestamp.'.pdf');
    }
}