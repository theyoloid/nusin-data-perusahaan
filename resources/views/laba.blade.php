<x-layout>
    {{-- Heading --}}
    <div class="flex gap-2 my-4 place-items-center">
        <h1 class="font-bold text-stone-700 text-3xl">Laporan Laba Bersih {{$divisinya}}</h1>
        <a href="export{{ Request::getRequestUri() }}"  class="px-3 py-2 text-sm hover:bg-blue-50 rounded-lg text-blue-600 w-fit flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 my-auto">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
            <p class="my-auto">Download PDF</p>
        </a>
        <hr class="border-stone-500">
    </div>
    {{-- The Filter --}}

    <div class="antialiased sans-serif  h-screen">
        {{-- The Tables --}}
        <div class="container mx-auto" x-data="datatables()" x-cloak>
            {{-- Filter, Search, dll --}}
            <form action="#" method="get" class="bg-blue-50 w-fit px-8 py-2 rounded-full">  
                <div class="md:flex justify-between items-center">
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
                        {{-- Search By MEREK --}}
                        <div class="flex gap-4">
                            <label for="default-search" class="mb-2 text-sm font-medium text-stone-900 sr-only dark:text-stone-500">Search By Merek</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-stone-500 dark:text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="search" id="default-search" name="searchmerek" class="block w-full px-4 pl-10 text-sm text-stone-900 border border-stone-300 rounded-lg bg-stone-50 focus:ring-stone-500 focus:border-stone-500 dark:bg-stone-700 dark:border-stone-600 dark:placeholder-stone-400 dark:text-stone-500 dark:focus:ring-stone-500 dark:focus:border-stone-500" placeholder="Cari Merek" value="{{request('searchmerek')}}">
                            </div>
                        </div>

                        {{-- Search V2 : Filter by Kode Item dan No Transaksi--}}
                            {{-- Search By No Transaksi --}}
                            <div class="flex gap-4">
                                <label for="default-search" class="mb-2 text-sm font-medium text-stone-900 sr-only dark:text-stone-500">Search By No Transaksi</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-stone-500 dark:text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <input type="search" id="default-search" name="searchnotrans" class="block w-full px-4 pl-10 text-sm text-stone-900 border border-stone-300 rounded-lg bg-stone-50 focus:ring-stone-500 focus:border-stone-500 dark:bg-stone-700 dark:border-stone-600 dark:placeholder-stone-400 dark:text-stone-500 dark:focus:ring-stone-500 dark:focus:border-stone-500" placeholder="Cari No Transaksi" value="{{request('searchnotrans')}}">
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

            {{-- Kesimpulan Filter --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative my-8">
                <table>
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-stone-600">
                                Nama Merek
                            </th>
                            
                            @foreach ($filter as $item)
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
                            @foreach ($filter as $item)
                            <td class="px-6 py-4">
                                {{$item->total_laba}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                {{-- Table Start Here --}}
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    {{-- Table Head --}}
                    <thead>
                        <tr class="text-left">
                            <template x-for="heading in headings">
                                <th class="bg-blue-50 sticky top-0 border-b border-stone-200 px-6 py-2 text-stone-600 font-bold tracking-wider uppercase text-xs"
                                    x-text="heading.value" :x-ref="heading.key" :class="{ [heading.key]: true }"></th>
                            </template>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="user in users" :key="user.userId">
                            @foreach ($dataLaba as $data)
                            <tr>
                                {{-- PartOfTable --}}
                                <td class="border-dashed border-t border-gray-200 keyIdDetail">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{$data->iddetail}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyNoTransaksi">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{$data->notransaksi}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyKodeItem">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{$data->kodeitem}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyJumlahDasar">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->jumlahdasar}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyHargaDasar">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->hargadasar}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyMerek">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->merek}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyDateUpd">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{$data->dateupd}}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 keyLaba">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"
                                    >{{$data->laba}}</span>
                                </td>
                            </tr>
                            @endforeach

                        </template>
                    </tbody>
                </table>
            </div>
            <div class="my-8">
                {{ $dataLaba->links() }}
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
                            'key': 'keyKodeItem',
                            'value': 'Kode Item'
                        },
                        {
                            'key': 'keyJumlahDasar',
                            'value': 'Jumlah Dasar'
                        },
                        {
                            'key': 'keyHargaDasar',
                            'value': 'Harga'
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
                            'key': 'keyLaba',
                            'value': 'Laba'
                        },
                    ],
                    users: [{
                        // "keyIdDetail": "G21222104815",
                        // "keyNoTransaksi": "AP51EMH6",
                        // "keyKodeItem": "G21222104815-KUJ-638079940567643185",
                        // "keyJumlahDasar": "30 Des 2022, 10.49.05",
                        // "keyHargaDasar": "45000",
                        // "keyMerek": "Auto",
                        // "keyDateUpd": "PE0571",
                        // "keyLaba": "---",
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