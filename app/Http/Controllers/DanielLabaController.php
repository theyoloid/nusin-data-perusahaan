<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DanielLaba;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class DanielLabaController extends Controller
{
    public function index(Request $request) {
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;

        $plis = DanielLaba::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);


        
        //Hasil Filter untuk piutang
        $results = DB::connection('pgsql2')->table('tbl_laba_new')
            ->select('merek', DB::connection('pgsql2')->raw('SUM(laba) as total_laba'))
            ->whereBetween('dateupd', [
                    $start, $end,
                ])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();

        return view('laba', [
            'dataLaba' => $plis,
            'divisinya' => 'Daniel',
            'filter' => $results,
        ]);
    }

    public function exportPdf(Request $request) {
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $start = $request->start;
        $end = $request->end;
        $pagination= 10000000;

        $plis = DanielLaba::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
                
        //Hasil Filter untuk piutang
        $results = DB::connection('pgsql2')->table('tbl_laba_new')
            ->select('merek', DB::connection('pgsql2')->raw('SUM(laba) as total_laba'))
            ->whereBetween('dateupd', [
                    $start, $end,
                ])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
            
        $pdf = Pdf::loadView('pdf.export-laba', [
            'dataLaba' => $plis,
            'divisinya' => 'Daniel',
            'filter' => $results,
        ]);
        return $pdf->download('Daniel_labaBersih-'.Carbon::now()->timestamp.'.pdf');
    }
}