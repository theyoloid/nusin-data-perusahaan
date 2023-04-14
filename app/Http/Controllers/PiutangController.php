<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Piutang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class PiutangController extends Controller
{
    public function index(Request $request) {
        $searchsupel = $request->searchsupel;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;

        $plis = Piutang::where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        
        // Ini Variable untuk hasil filter based on merek
        $results = DB::connection('pgsql')->table('tbl_piutang')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(piutang), 'FM999G999G999D00')) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        return view('piutang', [
            'dataPiutang' => $plis,
            'divisinya' => 'TEST',
            'filter' => $results,
        ]);

    }

    public function exportPdf(Request $request) {
        $searchsupel = $request->searchsupel;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 10000000;

        $plis = Piutang::where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
                // Ini Variable untuk hasil filter based on merek
        $results = DB::connection('pgsql')->table('tbl_piutang')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(piutang), 'FM999G999G999D00')) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        $pdf = Pdf::loadView('pdf.export-piutang', [
            'dataPiutang' => $plis,
            'divisinya' => 'TEST',
            'filter' => $results,
        ]);
        return $pdf->download('pembayaranPiutang-'.Carbon::now()->timestamp.'.pdf');
    }
}