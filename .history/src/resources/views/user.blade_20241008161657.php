@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nav__item"><button class="header-nav__button" onclick="location.href='./'">ホーム</button></li>
    <li class="header-nav__item"><button class="header-nav__button" onclick="location.href='/user'">ユーザー一覧</button></li>
    <li class="header-nav__item"><button class="header-nav__button" onclick="location.href='./attendance'">日付一覧</button></li>
    <li class="header-nav__item">
        <form action="/logout" method="post">
            @csrf
            <button class="header-nav__button">ログアウト</button>
        </form>
    </li>
</ul>
@endsection

@section('main')
<div class="main-container">
    <table class="main-table">
        <tr>
            <th>名前</th>
            <th>登録日</th>
            <th></th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email_verified_at }}</td>
            <form action="/user/attendance" method="get">
                <input type="hidden" name="user_id" value="$user->id">
                <button>勤務一覧</button>
            </form>
        </tr>
        @endforeach
    </table>
</div>

@endsection