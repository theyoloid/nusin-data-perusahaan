
<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-stone-600 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-stone-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <div class="mx-4 my-4">
         <h1 class="font-bold text-2xl">Laporan</h1>
      </div>
      <ul class="space-y-2 font-medium">
         <li>
            <a href="/" class="flex items-center p-2 text-stone-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <span class="ml-3">Dashboard</span>
            </a>
         </li>

         {{-- Database JATIM --}}
         <li>
            <button type="button" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>JATIM</span>
                  <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                  <li>
                     <a href="/jatim/penjualan" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Penjualan</a>
                  </li>
                  <li>
                     <a href="/jatim/laba" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Laba</a>
                  </li>
                  <li>
                     <a href="/jatim/piutang" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Piutang</a>
                  </li>
            </ul>
         </li>
         {{-- Database DANIEL --}}
         <li>
            <button type="button" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
                  <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>DANIEL</span>
                  <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <ul id="dropdown-example2" class="hidden py-2 space-y-2">
                  <li>
                     <a href="/daniel/penjualan" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Penjualan</a>
                  </li>
                  <li>
                     <a href="/daniel/laba" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Laba</a>
                  </li>
                  <li>
                     <a href="/daniel/piutang" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Piutang</a>
                  </li>
            </ul>
         </li>
         {{-- Database KJN --}}
         <li>
            <button type="button" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example3" data-collapse-toggle="dropdown-example3">
                  <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>KJN</span>
                  <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <ul id="dropdown-example3" class="hidden py-2 space-y-2">
                  <li>
                     <a href="/kjn/penjualan" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Penjualan</a>
                  </li>
                  <li>
                     <a href="/kjn/laba" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Laba</a>
                  </li>
                  <li>
                     <a href="/kjn/piutang" class="flex items-center w-full p-2 text-stone-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Piutang</a>
                  </li>
            </ul>
         </li>
         <li class="px-4 py-8">
            <form action="{{route('logout')}}" method="post">
               @csrf
               <button type="submit" class="w-full text-stone-600 hover:text-white border-4 border-blue-100 hover:border-0 bg-blue-50 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Logout</button>
            </form>
         </li>

      </ul>
   </div>
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      p
   </div>
</aside>
