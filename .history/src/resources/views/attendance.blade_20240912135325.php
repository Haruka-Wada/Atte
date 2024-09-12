@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nav__item"><button class="header-nav__button" onclick="location.href='./'">ホーム</button></li>
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
    <div class="main-date"></div>
    <table class="main-table">
        <tr>
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach($works as $work)
        <tr>
            <th>{{ $work->user->name }}</th>
            <th>{{ $work->start_time->format('H:i:s') }}</th>
            <th>{{ $work->end_time ? $work->end_time->format('') : '' }}</th>
            <th></th>
            <th></th>
        </tr>
        @endforeach
    </table>
    <div class="main-pagination"></div>
</div>
@endsection