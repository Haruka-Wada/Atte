@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nav__item"><a class="header-nav__link" href='./'>ホーム</a></li>
    <li class="header-nav__item"><a class="header-nav__link" href='/user'>ユーザー一覧</button></li>
    <li class=" header-nav__item"><a class="header-nav__link" href='/attendance'>日付一覧</a></li>
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
            <td>{{ $user->email_verified_at->format('Y-m-d') ? $user->email_verified_at->format('Y-m-d') : '認証待ち' }}</td>
            <td>
                <form action="/user/attendance" method="get">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button class="attendance-btn">勤務一覧</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection