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
    <table>
        <tr>
            <th>名前</th>
            <th>登録日</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>
                <form action="/user/{{ $user->name }}" method="get">
                    <input type="text" name="user_name" value="{{ $user->name }}">
                    <input type="hidden" name>
                </form>
            </td>
            <td>{{ $user->email_verified_at }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection