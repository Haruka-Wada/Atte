<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header_container">
            <h1 class="header_logo">Atte</h1>
            <nav>
                <ul class="header-nav">
                    <li class="header-nav__item"><a class="header-nav__link" href='/'>ホーム</a></li>
                    <li class="header-nav__item"><a class="header-nav__link" href='/user'>ユーザー一覧</button></li>
                    <li class=" header-nav__item"><a class="header-nav__link" href='/attendance'>日付一覧</a></li>
                    <li class="header-nav__item">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="header-nav__button">ログアウト</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        @yield('main')
    </main>
    <footer>
        <p class="footer_logo">Atte,inc.</p>
    </footer>
</body>

</html>