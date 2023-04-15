<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JatimPiutang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class JatimPiutangController extends Controller
{
    public function index(Request $request) {
        $searchsupel = $request->searchsupel;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;

        $plis = JatimPiutang::where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        
        // Ini Variable untuk hasil filter based on merek
        $results = DB::connection('pgsql1')->table('tbl_piutang')
            ->select('merek', 
            DB::raw("CAST(SUM(piutang) AS FLOAT) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        return view('piutang', [
            'dataPiutang' => $plis,
            'divisinya' => 'Jatim',
            'filter' => $results,
        ]);

    }

    public function exportPdf(Request $request) {
        $searchsupel = $request->searchsupel;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 10000000;

        $plis = JatimPiutang::where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);

        // Ini Variable untuk hasil filter based on merek
        $results = DB::connection('pgsql1')->table('tbl_piutang')
            ->select('merek', 
            DB::raw("CAST(SUM(piutang) AS FLOAT) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        $pdf = Pdf::loadView('pdf.export-piutang', [
            'dataPiutang' => $plis,
            'divisinya' => 'Jatim',
            'filter'=> $results,
        ]);
        return $pdf->download('pembayaranPiutang-'.Carbon::now()->timestamp.'.pdf');
    }
}