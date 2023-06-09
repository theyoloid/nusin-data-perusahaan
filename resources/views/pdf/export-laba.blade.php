<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Laba</title>

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
    <h1 class="font">Laporan Laba Bersih   {{$divisinya}}</h1>
    <div class="inline">
        <div class="inline">
            <p class="font w-1/2">Time Export: {{ date("Y-m-d H:i:s")}}</p>
            <p class="font w-1/2">Merek : {{request('searchmerek')}}</p>
        </div>
        <div class="inline">
            <p class="font w-1/2">Tanggal : {{request('start')}} - {{request('end')}}</p>
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
                    Rp. {{ number_format((float) str_replace(',', '', $item->total_laba), 2, ',', '.') }}
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
                <th class="table-font">Kode Item</th>
                <th class="table-font">Jumlah Dasar</th>
                <th class="table-font">Harga</th>
                <th class="table-font">Merek</th>
                <th class="table-font">Date Update</th>
                <th class="table-font">Laba</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataLaba as $data)                                    
            <tr>
                <td class="table-font">{{$nomor++}}</td>
                <td class="table-font">{{$data->iddetail}}</td>
                <td class="table-font">{{$data->notransaksi}}</td>
                <td class="table-font">{{$data->kodeitem}}</td>
                <td class="table-font">{{$data->jumlahdasar}}</td>
                <td class="table-font">{{$data->hargadasar}}</td>
                <td class="table-font">{{$data->merek}}</td>
                <td class="table-font">{{$data->dateupd}}</td>
                <td class="table-font">{{$data->laba}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>
</html>