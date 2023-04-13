<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DanielPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class DanielPenjualanController extends Controller
{
    public function index(Request $request) {
        $searchitem = $request->searchitem;
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;
        
        $plis = DanielPenjualan::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        //Hasil Filter untuk piutang
        $results = DB::connection('pgsql2')->table('tbl_ikdt2')
            ->select('merek', DB::connection('pgsql2')->raw('SUM(total) as total_penjualan'))
            ->whereBetween('dateupd', [
                    $start, $end,
                ])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
        
        return view('penjualan', [
            'divisinya' => 'Daniel',
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

        $plis = DanielPenjualan::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->where('kodeitem', 'LIKE', '%' .$searchitem. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);

        //Hasil Filter untuk piutang
        $results = DB::connection('pgsql2')->table('tbl_ikdt2')
            ->select('merek', DB::connection('pgsql2')->raw('SUM(total) as total_penjualan'))
            ->whereBetween('dateupd', [
                    $start, $end,
                ])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();

        
        $pdf = Pdf::loadView('pdf.export-penjualan', [
            'dataPenjualan' => $plis,
            'divisinya' => 'Daniel',
            'filter' => $results,
        ]);
        return $pdf->download('DanielPenjualan-'.Carbon::now()->timestamp.'.pdf');
    }
}