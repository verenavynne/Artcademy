<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artcademy</title>
    @include('custom.bootstrap')
    <link href="https://fonts.googleapis.com/css2?family=Afacad&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        @include('layouts.navbar')
    </header>
    <div class="content">
        @yield('content')
    </div>
    <footer>
        @include('layouts.footer')
    </footer>
</body>
<style>
    body {
        font-family: 'Afacad', sans-serif;
    }
</style>
</html>