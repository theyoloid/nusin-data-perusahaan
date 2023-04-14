<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class PenjualanController extends Controller
{
    public function index(Request $request) {
        $searchitem = $request->searchitem;
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;
        
        $plis = Penjualan::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        //Hasil Filter SALES untuk Penjualan
        $results = DB::connection('pgsql')
            ->table('tbl_ikdt2')
            ->select('merek', 
                DB::raw("('Rp. ' || trim(to_char(SUM(total), 'FM999G999G999D00'), '0')) as total_penjualan_idr")) 
            ->whereBetween('dateupd', [$start, $end])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
        
        return view('penjualan', [
            'divisinya' => 'TEST',
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

        $plis = Penjualan::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        //Hasil Filter SALES untuk Penjualan
        $results = DB::connection('pgsql')
            ->table('tbl_ikdt2')
            ->select('merek', 
                DB::raw("('Rp. ' || trim(to_char(SUM(total), 'FM999G999G999D00'), '0')) as total_penjualan_idr")) 
            ->whereBetween('dateupd', [$start, $end])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();

        // Export ke PDF
        $pdf = Pdf::loadView('pdf.export-penjualan', [
            'dataPenjualan' => $plis,
            'divisinya' => 'TEST',
            'filter' => $results,
        ]);
        return $pdf->download('TESTPenjualan-'.Carbon::now()->timestamp.'.pdf');
    }
}