<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    {{-- css --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('asset/flowbite/flowbite.min.css')}}">
</head>
<body>
    <section class="bg-blue-50 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="grid text-center mb-6 gap-2">
                <p class="text-3xl font-bold text-gray-900">
                    Data Report Apps
                </p>
                <h1 class="text-lg font-semibold leading-tight tracking-tight text-stone-900">
                    Sign in to your account
                </h1>
            </div>
            <div class="mx-auto bg-white rounded-lg shadow md:mt-0 sm:max-w-4xl xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <form class="space-y-4 md:space-y-6" method="post" action="#">
                        <div>
                            <input type="username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Username" required="">
                        </div>
                        <div>
                        <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    {{-- Flowbite --}}
    <script src="{{asset('asset/flowbite/flowbite.min.js')}}"></script>
    <script src="{{asset('asset/flowbite/datepicker.min.js')}}"></script>
    <script src="{{asset('asset/alpinejs/alpine.js')}}"></script>
    <script src="{{asset('asset/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('asset/jQuery.min.js')}}"></script>
</body>
</html>