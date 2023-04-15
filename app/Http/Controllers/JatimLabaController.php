<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JatimLaba;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class JatimLabaController extends Controller
{
    public function index(Request $request) {
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;

        $plis = JatimLaba::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        //Hasil Filter untuk piutang
        $results = DB::connection('pgsql1')->table('tbl_laba_new')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(laba), 'FM999G999G999D00')) as total_laba")) 
            ->whereBetween('dateupd', [$start, $end])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();

        return view('laba', [
            'dataLaba' => $plis,
            'divisinya' => 'Jatim',
            'filter' => $results,
        ]);
    }

    public function exportPdf(Request $request) {
        $searcnotrans = $request->searchnotrans;
        $searchmerek = $request->searchmerek;
        $start = $request->start;
        $end = $request->end;
        $pagination= 10000000;

        $plis = JatimLaba::where('merek', 'LIKE', '%' .$searchmerek. '%')
                ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);

        //Hasil Filter untuk piutang
        $results = DB::connection('pgsql1')->table('tbl_laba_new')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(laba), 'FM999G999G999D00')) as total_laba")) 
            ->whereBetween('dateupd', [$start, $end])
            ->where('merek', 'LIKE', '%' .$searchmerek. '%')
            ->where('notransaksi', 'LIKE', '%' .$searcnotrans. '%')
            ->groupBy('merek')
            ->orderBy('merek', 'asc')
            ->get();
            
        $pdf = Pdf::loadView('pdf.export-laba', [
            'dataLaba' => $plis,
            'divisinya' => 'Jatim',
            'filter'=> $results,
        ]);
        return $pdf->download('JATIM_labaBersih-'.Carbon::now()->timestamp.'.pdf');
    }
}