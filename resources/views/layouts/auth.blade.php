<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>MARBLE BLUE | {{ $title ??  config('app.name', 'Laravel') }}</title>
  </head>
  <body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="relative flex flex-col m-2 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
        @yield('container')
      </div>
    </div>

    @vite('resources/js/app.js')
  </body>
</html>