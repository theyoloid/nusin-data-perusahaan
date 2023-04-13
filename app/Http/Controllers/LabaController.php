<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Laba;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class LabaController extends Controller
{
    public function index(Request $request) {
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;

        $plis = Laba::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        //Hasil Filter untuk piutang
        $results = DB::connection('pgsql1')->table('tbl_laba_new')
            ->select('merek', DB::connection('pgsql1')->raw('SUM(laba) as total_laba'))
            ->whereBetween('dateupd', [
                    $start, $end,
                ])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();

        return view('laba', [
            'dataLaba' => $plis,
            'divisinya' => 'Test',
            'filter' => $results,
        ]);
    }

    public function exportPdf(Request $request) {
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $start = $request->start;
        $end = $request->end;
        $pagination= 10000000;

        $plis = Laba::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);

        //Hasil Filter untuk piutang
        $results = DB::connection('pgsql1')->table('tbl_laba_new')
            ->select('merek', DB::connection('pgsql1')->raw('SUM(laba) as total_laba'))
            ->whereBetween('dateupd', [
                    $start, $end,
                ])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
        
        // Export to PDF
        $pdf = Pdf::loadView('pdf.export-laba', [
            'dataLaba' => $plis,
            'divisinya' => 'Test',
            'filter'=> $results,
        ]);
        return $pdf->download('TEST_labaBersih-'.Carbon::now()->timestamp.'.pdf');
    }
}