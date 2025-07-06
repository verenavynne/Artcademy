<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artcademy</title>
    @include('custom.bootstrap')
</head>
<body>
    <header>
        @include('layouts.navbar')
    </header>
    <body>
        @yield('content')
    </body>
    <footer>
        @include('layouts.footer')
    </footer>
</body>
</html>