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
            <nav>
                @yield('nav')
            </nav>
        </div>
    </header>
    <main>
    @yield('main')
        </div>
    </main>
    <footer>
        <p class="footer_logo">Atte,inc.</p>
    </footer>
</body>

</html>