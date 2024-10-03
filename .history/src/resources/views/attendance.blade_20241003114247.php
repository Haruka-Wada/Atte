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
            <button class="main-date__button" name="sub" value="sub">&lsaquo;</button>
                <input type="text" class="main-date__input" name="dt" value="{{!empty($dt) ? $dt : \Carbon\Carbon::now()->toDateString()}}">
            <button class="main-date__button" name="add" value="add">&rsaquo;</button>
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

        @isset($works)
        @foreach($works as $work)
        <tr>
            <td>{{ $work->user->name }}</td>
            <td>{{ $work->start_time->format('H:i:s') }}</td>
            <td>{{ $work->end_time ? $work->end_time->format('H:i:s') : '' }}</td>
            <td>{{ $work->rest_time ? $work->rest_time->format('H:i:s') : '' }}</td>
            <td>{{ $work->work_time ? $work->work_time->format('H:i:s') : '' }}</td>
        </tr>
        @endforeach
        @endisset
    </table>
    <div class="main-pagination">
        {{ $works->links('vendor.pagination.bootstrap-4') }}
    </div>
    @endsection