<x-layout>
    <div class="grid gap-2 my-4">
        <h1 class="font-bold text-stone-700 text-3xl"> Laporan Genereal</h1>
        <hr class="border-stone-500">
    </div>
    {{-- Filter, Search, dll --}}
    <form action="#" method="get" class="bg-blue-50 w-fit px-8 py-2 rounded-full mx-auto">  
        <div class="md:flex justify-between items-center">
            <div class="grid md:flex gap-4">
                <div class="md:flex">
                    <h1 class="font-semibold text-stone-700 my-auto">Select date to view data.</h1>
                </div>
                {{-- DatePicker --}}                    
                <div date-rangepicker class="flex items-center w-80">
                    {{-- Select Start day --}}
                    <div class="relative w-fit">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-stone-500 dark:text-stone-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input name="start" type="text" class="bg-stone-50 border border-stone-300 text-stone-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full pl-10 p-2.5  dark:bg-stone-700 dark:border-stone-600 dark:placeholder-stone-400 dark:text-stone-500 dark:focus:ring-stone-500 dark:focus:border-stone-500" value="{{request('start')}}" placeholder="Start Date">
                    </div>
                    <span class="mx-4 text-stone-500">to</span>
                    {{-- End Date --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-stone-500 dark:text-stone-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input name="end" type="text" class="bg-stone-50 border border-stone-300 text-stone-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full pl-10 p-2.5  dark:bg-stone-700 dark:border-stone-600 dark:placeholder-stone-400 dark:text-stone-500 dark:focus:ring-stone-500 dark:focus:border-stone-500" value="{{request('end')}}" placeholder="End Date">
                    </div>
                </div>

                {{-- Select Sales --}}
                <div class="flex gap-4">
                    <label for="default-search" class="mb-2 text-sm font-medium text-stone-900 sr-only dark:text-stone-500">Search By Sales</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-stone-500 dark:text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="search" id="default-search" name="searchsales" class="block w-full px-4 pl-10 text-sm text-stone-900 border border-stone-300 rounded-lg bg-stone-50 focus:ring-stone-500 focus:border-stone-500 dark:bg-stone-700 dark:border-stone-600 dark:placeholder-stone-400 dark:text-stone-500 dark:focus:ring-stone-500 dark:focus:border-stone-500" placeholder="Cari Sales" value="{{request('searchsales')}}">
                    </div>
                </div>

                {{-- Button --}}
                <div class="md:flex">
                    <button type="submit" class="flex items-center text-stone-700 px-5 py-2 rounded-full bg-blue-200 hover:bg-blue-800 hover:text-white">
                        <p>Submit</p>
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- JATIM --}}
    <div class="border bg-gray-50 grid px-4 pt-4 pb-8 gap-4 rounded-3xl my-8">
        {{-- Heading --}}
        <h1 class="font-semibold text-center text-stone-700 text-2xl">Laporan JATIM</h1>
        {{-- Rekap Laporan Penjualan --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Laporan Penjualan</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            @foreach ($jatimPenjualan as $item)
                            <th class="px-6 py-2 text-xs text-stone-800">
                                {{$item->merek}}
                                {{-- Merek --}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($jatimPenjualan as $item)
                            <td class="px-6 py-4">
                                {{$item->total_penjualan_idr}}
                                {{-- Total Penjualan --}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rekap Laporan Laba --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Laporan Laba</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            
                            @foreach ($jatimLaba as $item)
                            <th class="px-6 py-2 text-xs text-gray-500">
                                {{$item->merek}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($jatimLaba as $item)
                            <td class="px-6 py-4">
                                {{$item->total_laba}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rekap Laporan Pembayaran Piutang --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Pembayaran Piutang</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            
                            @foreach ($jatimPiutang as $item)
                            <th class="px-6 py-2 text-xs text-gray-500">
                                {{$item->merek}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($jatimPiutang as $item)
                            <td class="px-6 py-4">
                                {{$item->total_piutang}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- DANIEL --}}
    <div class="border bg-gray-50 grid px-4 pt-4 pb-8 gap-4 rounded-3xl my-8">
        {{-- Heading --}}
        <h1 class="font-semibold text-center text-stone-700 text-2xl">Laporan Daniel</h1>
        {{-- Rekap Laporan Penjualan --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Laporan Penjualan</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            @foreach ($danielPenjualan as $item)
                            <th class="px-6 py-2 text-xs text-stone-800">
                                {{$item->merek}}
                                {{-- Merek --}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($danielPenjualan as $item)
                            <td class="px-6 py-4">
                                {{$item->total_penjualan_idr}}
                                {{-- Total Penjualan --}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rekap Laporan Laba --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Laporan Laba</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            
                            @foreach ($danielLaba as $item)
                            <th class="px-6 py-2 text-xs text-gray-500">
                                {{$item->merek}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($danielLaba as $item)
                            <td class="px-6 py-4">
                                {{$item->total_laba}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rekap Laporan Pembayaran Piutang --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Laporan Pembayaran Piutang</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            
                            @foreach ($danielPiutang as $item)
                            <th class="px-6 py-2 text-xs text-gray-500">
                                {{$item->merek}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($danielPiutang as $item)
                            <td class="px-6 py-4">
                                {{$item->total_piutang}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- KJN --}}
    <div class="border bg-gray-50 grid px-4 pt-4 pb-8 gap-4 rounded-3xl my-8">
        {{-- Heading --}}
        <h1 class="font-semibold text-center text-stone-700 text-2xl">Laporan KJN</h1>
        {{-- Rekap Laporan Penjualan --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Laporan Penjualan</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            @foreach ($kjnPenjualan as $item)
                            <th class="px-6 py-2 text-xs text-stone-800">
                                {{$item->merek}}
                                {{-- Merek --}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($kjnPenjualan as $item)
                            <td class="px-6 py-4">
                                {{$item->total_penjualan_idr}}
                                {{-- Total Penjualan --}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rekap Laporan Laba --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Laporan Laba</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            
                            @foreach ($kjnLaba as $item)
                            <th class="px-6 py-2 text-xs text-gray-500">
                                {{$item->merek}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($kjnLaba as $item)
                            <td class="px-6 py-4">
                                {{$item->total_laba}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Rekap Laporan Pembayaran Piutang --}}
        <div class="grid gap-4">
            <h1 class="font-semibold text-stone-700 text-xl">Rekap Laporan Pembayaran Piutang</h1>
            {{-- REKAP --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            
                            @foreach ($kjnPiutang as $item)
                            <th class="px-6 py-2 text-xs text-gray-500">
                                {{$item->merek}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Total
                            </td>
                            @foreach ($kjnPiutang as $item)
                            <td class="px-6 py-4">
                                {{$item->total_piutang}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layout>