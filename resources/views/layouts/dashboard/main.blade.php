<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>MARBLE BLUE | {{ $title ??  config('app.name', 'Laravel') }}</title>
</head>
<body class="text-gray-800 font-inter">
    

    @include('layouts/dashboard/sidebar')

    <!-- start: Main -->
    <main class="mainDashboard w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        @include('layouts/dashboard/navbar')
        <div class="p-6">
            @yield('container')
        </div>
    </main>
    <!-- end: Main -->

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    @vite('resources/js/app.js')
</body>
</html>