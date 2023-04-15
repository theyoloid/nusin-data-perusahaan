<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KjnPiutang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class KjnPiutangController extends Controller
{
    public function index(Request $request) {
        $searchsupel = $request->searchsupel;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 100;

        $plis = KjnPiutang::where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        
        // Ini Variable untuk hasil filter based on merek
        $results = DB::connection('pgsql3')->table('tbl_piutang')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(piutang), 'FM999G999G999D00')) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
        
        return view('piutang', [
            'dataPiutang' => $plis,
            'divisinya' => 'Kjn',
            'filter' => $results,
        ]);

    }

    public function exportPdf(Request $request) {
        $searchsupel = $request->searchsupel;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        $pagination= 10000000;

        $plis = KjnPiutang::where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);
        
        // Ini Variable untuk hasil filter based on merek
        $results = DB::connection('pgsql3')->table('tbl_piutang')
            ->select('merek', 
                DB::raw("('Rp. ' || to_char(SUM(piutang), 'FM999G999G999D00')) as total_piutang"))
            ->whereBetween('dateupd', [$start, $end,])
            ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
            ->where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
            ->groupBy('merek')
            ->orderBy('total_piutang', 'asc')
            ->get();
            
        $pdf = Pdf::loadView('pdf.export-piutang', [
            'dataPiutang' => $plis,
            'divisinya' => 'Kjn',
            'filter' => $results,
        ]);
        return $pdf->download('pembayaranPiutang-'.Carbon::now()->timestamp.'.pdf');
    }
}