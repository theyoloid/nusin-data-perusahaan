<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Report</title>

    {{-- css --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('asset/flowbite/flowbite.min.css')}}">
</head>
<body>
        {{-- <x-sidebar-v2></x-sidebar-v2> --}}
        <x-sidebar></x-sidebar>
        <div class="p-4 sm:ml-72">
            
            {{ $slot }}
        </div>

    {{-- Flowbite --}}
    <script src="{{asset('asset/flowbite/flowbite.min.js')}}"></script>
    <script src="{{asset('asset/flowbite/datepicker.min.js')}}"></script>
    <script src="{{asset('asset/alpinejs/alpine.js')}}"></script>
    <script src="{{asset('asset/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('asset/jQuery.min.js')}}"></script>
</body>
</html>