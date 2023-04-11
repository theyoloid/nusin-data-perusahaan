<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DanielLaba;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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

        return view('laba', [
            'dataLaba' => $plis,
            'divisinya' => 'Daniel'
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
        $pdf = Pdf::loadView('pdf.export-laba', [
            'dataLaba' => $plis,
            'divisinya' => 'Daniel'
        ]);
        return $pdf->download('labaBersih-'.Carbon::now()->timestamp.'.pdf');
    }
}