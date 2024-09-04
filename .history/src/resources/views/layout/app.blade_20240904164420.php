<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header_container">
            <h1 class="header_logo">Atte</h1>
        </div>
        <nav>
            @yield('nav')
        </nav>
    </header>
    <main>
        <div class="main_container">
            @
        </div>
    </main>
</body>

</html>