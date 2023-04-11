<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JatimPiutang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\Paginator;

class JatimPiutangController extends Controller
{
    public function index(Request $request) {
        $searchsupel = $request->searchsupel;
        $searchsales = $request->searchsales;
        $start = $request->start;
        $end = $request->end;
        // $sales = $request->sales;
        $pagination= 100;

        $plis = JatimPiutang::where('kodesupel', 'LIKE', '%' .$searchsupel. '%')
                ->where('kodesales', 'LIKE', '%' .$searchsales. '%')
                ->whereBetween('dateupd', [
                    $start, $end,
                ])
                ->paginate($pagination);

        return view('piutang', [
            'dataPiutang' => $plis,
            'divisinya' => 'Jatim'
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
        $pdf = Pdf::loadView('pdf.export-piutang', [
            'dataPiutang' => $plis,
            'divisinya' => 'Jatim',
        ]);
        return $pdf->download('pembayaranPiutang-'.Carbon::now()->timestamp.'.pdf');
    }
}