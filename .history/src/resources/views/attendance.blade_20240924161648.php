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
    <div class="main-date">
        <form action="/attendance" method="post">
            @csrf
            <button class="main-date__button" name="sub" value="sub">
                <</button>
                    <input type="text" class="main-date__input" name="dt" value="{{ $dt }}">
                    <button class="main-date__button" name="add" value="add">></button>
        </form>
    </div>
    <table class="main-table">
        <tr>
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach($workTimes as $workTime)
        <tr>
            <td>{{ $workTime->user_name ? $work }}</td>
            <td>{{ $workTime->start_time }}</td>
            <td>{{ $workTime->end_time ? $workTime->end_time : '' }}</td>
            <td>{{ $workTime->restTime }}</td>
            <td>{{ $work->WorkDiffInSeconds() }}</td>
        </tr>
        @endforeach
    </table>
    <div class="main-pagination">
        {{ $works->links() }}
    </div>
</div>
@endsection