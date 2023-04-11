<x-layout>
    <div class="grid gap-2 my-4">
        <h1 class="font-bold text-stone-700 text-3xl">Laporan Piutang {{$divisinya}}</h1>
        <a href="export{{ Request::getRequestUri() }}"  class="underline text-blue-600">Export PDF</a>

        <hr class="border-stone-500">
    </div>
    {{-- The Filter --}}

    {{-- The Tables --}}
    <!-- component -->
    <div class="antialiased sans-serif  h-screen">
        {{-- The Tables --}}
        <div class="container mx-auto py-6 px-4" x-data="datatables()" x-cloak>
            {{-- Filter, Search, dll --}}
            <form action="#" method="get">  
                <div class="mb-4 md:flex justify-between items-center">
                    <div class="grid md:flex gap-4">
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
                        
                        {{-- Search V1 : Filter by Merek and Sales --}}
                        <div class="md:flex gap-4 w-72">
                            {{-- Search By MEREK --}}
                            <div class="flex gap-4">
                                <label for="default-search" class="mb-2 text-sm font-medium text-stone-900 sr-only dark:text-stone-500">Search By Pelanggan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-stone-500 dark:text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <input type="search" id="default-search" name="searchsupel" class="block w-full px-4 pl-10 text-sm text-stone-900 border border-stone-300 rounded-lg bg-stone-50 focus:ring-stone-500 focus:border-stone-500 dark:bg-stone-700 dark:border-stone-600 dark:placeholder-stone-400 dark:text-stone-500 dark:focus:ring-stone-500 dark:focus:border-stone-500" placeholder="Cari Pelanggan" value="{{request('searchsupel')}}">
                                </div>
                            </div>

                            {{-- Search By Sales --}}
                            <div class="flex gap-4">
                                <label for="default-search" class="mb-2 text-sm font-medium text-stone-900 sr-only dark:text-stone-500">Search By No Transaksi</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-stone-500 dark:text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <input type="search" id="default-search" name="searchsales" class="block w-full px-4 pl-10 text-sm text-stone-900 border border-stone-300 rounded-lg bg-stone-50 focus:ring-stone-500 focus:border-stone-500 dark:bg-stone-700 dark:border-stone-600 dark:placeholder-stone-400 dark:text-stone-500 dark:focus:ring-stone-500 dark:focus:border-stone-500" placeholder="Cari Sales" value="{{request('searchsales')}}">
                                </div>
                            </div>
                        </div>

                        {{-- Button --}}
                        <div class="md:flex">
                            <button type="submit" class="flex gap-2 items-center bg-stone-50 text-stone-500 px-4 py-2 rounded-md hover:bg-stone-800 hover:text-white">
                                <p>Submit</p>
                            </button>
                        </div>


                    </div>
                </div>
                </form>

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                {{-- Table Start Here --}}
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    {{-- Table Head --}}
                    <thead>
                        <tr class="text-left">
                            <template x-for="heading in headings">
                                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs"
                                    x-text="heading.value" :x-ref="heading.key" :class="{ [heading.key]: true }"></th>
                            </template>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="user in users" :key="user.userId">
                            @foreach ($dataPiutang as $data)
                            <tr>
                                {{-- PartOfTable --}}
                                <td class="border-dashed border-t border-gray-200 keyIdDetail">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{$data->iddetail}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyNoTransaksi">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{$data->notransaksi}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyNoTrsMasuk">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{$data->notrsmasuk}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyKodesupel">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{$data->kodesupel}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyKodeSales">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->kodesales}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyTanggal">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->tanggal}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyMerek">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->merek}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyDateUpd">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->dateupd}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyTotalByr">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->totalbayar}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyTotalPotongan">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->totalpotongan}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyPiutang">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                    >{{$data->piutang}}</span>
                                </td>
                            </tr>
                            @endforeach

                        </template>
                    </tbody>
                </table>
            </div>
            <div class="my-8 ">
                {{ $dataPiutang->links() }}
            </div>
        </div>

        <script>
            function datatables() {
                return {
                    headings: [
                        {
                            'key': 'keyIdDetail',
                            'value': 'ID Detail'
                        },
                        {
                            'key': 'keyNoTransaksi',
                            'value': 'NO Transaksi'
                        },
                        {
                            'key': 'keyNoTrsMasuk',
                            'value': 'No Transaksi Masuk'
                        },
                        {
                            'key': 'keyKodesupel',
                            'value': 'Kode Pelanggan'
                        },
                        {
                            'key': 'keyKodeSales',
                            'value': 'Kode Sales'
                        },
                        {
                            'key': 'keyTanggal',
                            'value': 'Tanggal'
                        },
                        {
                            'key': 'keyMerek',
                            'value': 'Merk'
                        },
                        {
                            'key': 'keyDateUpd',
                            'value': 'Date Update'
                        },
                        {
                            'key': 'keyTotalByr',
                            'value': 'Total Bayar'
                        },
                        {
                            'key': 'keyTotalPotongan',
                            'value': 'Total Potongan'
                        },
                        {
                            'key': 'keyPiutang',
                            'value': 'Piutang'
                        },
                    ],
                    users: [{
                        // "keyNoTrsMasuk": "G21222104815",
                        // "keyNoTransaksi": "AP51EMH6",
                        // "keyKodesupel": "G21222104815-KUJ-638079940567643185",
                        // "keyKodeSales": "30 Des 2022, 10.49.05",
                        // "keyTanggal": "45000",
                        // "keyMerek": "Auto",
                        // "keyDateUpd": "PE0571",
                        // "keyPiutang": "---",
                    }, 
                    ],
                    selectedRows: [],

                    open: false,
                    
                    toggleColumn(key) {
                        // Note: All td must have the same class name as the headings key! 
                        let columns = document.querySelectorAll('.' + key);

                        if (this.$refs[key].classList.contains('hidden') && this.$refs[key].classList.contains(key)) {
                            columns.forEach(column => {
                                column.classList.remove('hidden');
                            });
                        } else {
                            columns.forEach(column => {
                                column.classList.add('hidden');
                            });
                        }
                    },

                    getRowDetail($event, id) {
                        let rows = this.selectedRows;

                        if (rows.includes(id)) {
                            let index = rows.indexOf(id);
                            rows.splice(index, 1);
                        } else {
                            rows.push(id);
                        }
                    },

                    selectAllCheckbox($event) {
                        let columns = document.querySelectorAll('.rowCheckbox');

                        this.selectedRows = [];

                        if ($event.target.checked == true) {
                            columns.forEach(column => {
                                column.checked = true
                                this.selectedRows.push(parseInt(column.name))
                            });
                        } else {
                            columns.forEach(column => {
                                column.checked = false
                            });
                            this.selectedRows = [];
                        }
                    }
                }
            }
        </script>
    </div>  

</x-layout>