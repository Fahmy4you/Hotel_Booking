<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>MARBLE BLUE | {{ $title ??  config('app.name', 'Laravel') }}</title>
    <!-- favicon link -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <!-- google font link -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- tailwind css cdn -->
    @vite('resources/css/app.css')
    <!-- ionicons cdn -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- alpine js cdn -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- style css -->
    <style type="text/tailwindcss">
        body{
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="scroll-smooth">
    

<!-- ====== header ====== -->

<header x-data="{navbarOpen: false}" class="absolute sticky left-0 top-0 z-50 bg-white/90 w-full backdrop-blur">
    <div class="mx-auto h-[90px] max-w-7xl px-8 md:px-6">
        <div class="relative flex h-full items-center justify-between border-b border-slate-500/10">
            <!-- logo -->
            <div class="w-[15rem] max-w-full">
                <a href="{{ Route::currentRouteName() !== 'home' ? route('home') : '' }}#">
                    <img src="{{ asset('image/landing_page/logo.png') }}" alt="logo" class="w-full">
                </a>
            </div>

            <!-- menu -->
            <div class="flex w-full items-center justify-between">
                <nav x-transition :class="!navbarOpen && 'hidden'" id="navbarCollapse" class="absolute right-0 top-[90px] w-full max-w-[350px] rounded-lg border border-blue-200 bg-white py-5 px-6 shadow-lg shadow-blue-400/5 transition-all lg:static lg:block lg:max-w-full lg:border-none lg:shadow-none lg:bg-transparent lg:px-0 lg:py-0">
                    <ul class="flex flex-col justify-center gap-8 lg:flex-row">
                        <li>
                            <a href="{{ Route::currentRouteName() !== 'home' ? route('home') : '' }}#home" class="text-lg font-medium text-slate-700 duration-200 hover:text-blue-600 lg:text-base">Home</a>
                        </li>
                        <li>
                            <a href="{{ Route::currentRouteName() !== 'home' ? route('home') : '' }}#about" class="text-lg font-medium text-slate-700 duration-200 hover:text-blue-600 lg:text-base">About</a>
                        </li>
                        <li>
                            <a href="{{ Route::currentRouteName() !== 'home' ? route('home') : '' }}#galery" class="text-lg font-medium text-slate-700 duration-200 hover:text-blue-600 lg:text-base">Galery</a>
                        </li>
                        <li>
                            <a href="{{ Route::currentRouteName() !== 'home' ? route('home') : '' }}#room" class="text-lg font-medium text-slate-700 duration-200 hover:text-blue-600 lg:text-base">Best Room's</a>
                        </li>
                        <li>
                            <a href="{{ Route::currentRouteName() !== 'home' ? route('home') : '' }}#contact" class="text-lg font-medium text-slate-700 duration-200 hover:text-blue-600 lg:text-base">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- menu btn -->
            <div class="flex gap-x-5">
                @if(auth()->check())
                    <a href="{{ route('dashboard') }}" class="text-nowrap mr-10 hidden rounded-md bg-blue-500 px-6 py-1.5 font-semibold text-white shadow-md shadow-blue-500/20 duration-200 hover:bg-blue-600 sm:block lg:mr-0">My Dashboard</a>
                @else 
                    <a href="{{ route('login') }}" class="mr-10 hidden rounded-md bg-blue-500 px-6 py-1.5 font-semibold text-white shadow-md shadow-blue-500/20 duration-200 hover:bg-blue-600 sm:block lg:mr-0">Login</a>
                    <a href="{{ route('register') }}" class="mr-10 hidden rounded-md bg-blue-500 px-6 py-1.5 font-semibold text-white shadow-md shadow-blue-500/20 duration-200 hover:bg-blue-600 sm:block lg:mr-0">Register</a>
                @endif

                <button @click="navbarOpen = !navbarOpen" :class="navbarOpen && 'navbarTogglerActive'" id="navbarToggler" class="block lg:hidden">
                    <ion-icon name="menu-outline" class="text-4xl text-blue-500"></ion-icon>
                </button>
            </div>
        </div>
    </div>
</header>
<!-- ====== END header ====== -->

@yield('container')

<!-- ====== footer ====== -->

<footer class="bg-slate-50/80 pt-16">
    <div class="mx-auto max-w-7xl px-8 md:px-6">

        <!-- footer top -->
        <div class="grid gap-16 row-gap-10 mb-8 lg:grid-cols-6">
            <div class="md:max-w-md lg:col-span-2">
                <img src="{{ asset('image/landing_page/logo.png') }}" alt="footer logo" class="w-36">
                <div class="mt-4 lg:max-w-sm">
                    <p class="text-sm text-slate-500">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    <p class="text-sm text-slate-500 mt-2">Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
            </div>

            <div class="grid row-gap-8 grid-cols-2 gap-5 md:grid-cols-4 lg:col-span-4">
                <div class="">
                    <!-- head -->
                    <p class="font-semibold text-slate-700">Category</p>
                    <ul class="mt-2 space-y-2">
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">News</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">World</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Games</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">References</a></li>
                    </ul>
                </div>

                <div class="">
                    <!-- head -->
                    <p class="font-semibold text-slate-700">Business</p>
                    <ul class="mt-2 space-y-2">
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Web</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">eCommerce</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Business</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Entertainment</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Portfolio</a></li>
                    </ul>
                </div>

                <div class="">
                    <!-- head -->
                    <p class="font-semibold text-slate-700">Apples</p>
                    <ul class="mt-2 space-y-2">
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Media</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Brochure</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Nonprofit</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Educational</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Projects</a></li>
                    </ul>
                </div>

                <div class="">
                    <!-- head -->
                    <p class="font-semibold text-slate-700">Cherry</p>
                    <ul class="mt-2 space-y-2">
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Infopreneur</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Personal</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Wiki</a></li>
                        <li><a href="#" class="text-slate-500 transition-colors duration-300 hover:text-slate-700">Forum</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End footer top -->

        <!-- footer bottom -->
        <div class="flex flex-col justify-between border-t py-8 sm:flex-row">
            <p class="text-sm text-slate-500">© Copyright 2025 <a href="#" class="text-slate-700 hover:text-blue-500"> MARBLE BLUE</a> All rights reserved.</p>
            <div class="mt-4 flex items-center space-x-4 sm:mt-0">
                <a href="#">
                    <ion-icon name="logo-facebook" class="text-2xl text-slate-500 hover:text-blue-500 duration-300"></ion-icon>
                </a>
                <a href="#">
                    <ion-icon name="logo-twitter" class="text-2xl text-slate-500 hover:text-blue-500 duration-300"></ion-icon>
                </a>
                <a href="#">
                    <ion-icon name="logo-youtube" class="text-2xl text-slate-500 hover:text-blue-500 duration-300"></ion-icon>
                </a>
            </div>
        </div>
        <!-- End footer bottom -->

    </div>
</footer>

<!-- ====== END footer ====== -->

@vite('resources/js/app.js')

</body>
</html>