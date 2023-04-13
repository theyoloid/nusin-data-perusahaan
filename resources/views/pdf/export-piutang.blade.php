<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran Piutang</title>

    <style>
        h1 {
            font-size: 18px;
            font-weight: bold;
        }

        p {
            font-size: 10px
        }

        .table {
            border: 1px solid #999;
            padding: 2px 4px;
            border-collapse: collapse;
        }

        .inline {
            display: inline-flex;
            width: 100vh;
            margin: 0px 50px 0px 0px;
        }

        thead {
            font-weight: bold;
            background-color: #888;
            color: #ffffff;
        }
        
        td, th {
            border: 1px solid #888;
        }

        body {
            font-family: sans-serif;
        }

        .table-font {
            font-size: 8px;
        }
    </style>
</head>
<body>

    @php
        $nomor = 1;
    @endphp
    <h1 class="font">Laporan Piutang  {{$divisinya}}</h1>
    <div class="inline">
        <div class="inline">
            <p class="font w-1/2">Time Export: {{ date("Y-m-d H:i:s")}}</p>
            <p class="font w-1/2">Pelanggan : {{request('searchsupel')}}</p>
        </div>
        <div class="inline">
            <p class="font w-1/2">Tanggal : {{request('start')}} - {{request('end')}}</p>
            <p class="font w-1/2">Sales : {{request('sales')}}</p>
        </div>
        <div class="inline" style="border: 1px solid #000; padding: 0 10px;">
            <h1>Nilai (-) = Retur</h1>
        </div>
    </div>

    {{-- Kesimpulan Filter --}}
    <h5 style="margin: 10px 0;">Laporan Total Per Merek</h5>
    <table class="table">
        <thead >
            <tr>
                <th class="table-font" style="padding: 2px 20px;">
                    Nama Merek
                </th>                
                <th class="table-font" style="padding: 2px 20px;">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filter as $item)
            <tr>
                
                <td class="table-font">
                    {{$item->merek}}
                </td>
                <td class="table-font">
                    {{$item->total_piutang}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <h5 style="margin: 10px 0;">Rincian Laporan</h5>
    <table class="table">
        <thead>
            <tr>
                <th class="table-font">No</th>
                <th class="table-font">ID Detail</th>
                <th class="table-font">No Transaksi</th>
                <th class="table-font">No Transaksi Masuk (N)</th>
                <th class="table-font">Kode Pelanggan</th>
                <th class="table-font">Kode Sales</th>
                <th class="table-font">Tanggal (N)</th>
                <th class="table-font">Merek</th>
                <th class="table-font">Date Update</th>
                <th class="table-font">Total Bayar (N)</th>
                <th class="table-font">Total Potongan (N)</th>
                <th class="table-font">Piutang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPiutang as $data)                                    
            <tr>
                <td class="table-font">{{$nomor++}}</td>
                <td class="table-font">{{$data->iddetail}}</td>
                <td class="table-font">{{$data->notransaksi}}</td>
                <td class="table-font">{{$data->notrsmasuk}}</td>
                <td class="table-font">{{$data->kodesupel}}</td>
                <td class="table-font">{{$data->kodesales}}</td>
                <td class="table-font">{{$data->tanggal}}</td>
                <td class="table-font">{{$data->merek}}</td>
                <td class="table-font">{{$data->dateupd}}</td>
                <td class="table-font">{{$data->totalbayar}}</td>
                <td class="table-font">{{$data->totalpotongan}}</td>
                <td class="table-font">{{$data->piutang}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>
</html>