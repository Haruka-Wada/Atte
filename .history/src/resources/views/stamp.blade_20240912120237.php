@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
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
    <div class="main-message">
        <p>{{ $user->name }}さんお疲れ様です！</p>
    </div>
    <div class="main-item">
        <form action="/workStart" method="post" class="main-item__form">
            @csrf
            <button class="main-button ">勤務開始</button>
        </form>
        <form action="/workEnd" method="post" class="main-item__form">
            @csrf
            <button class="main-button">勤務終了</button>
        </form>
        <form action="/restStart" method="post">
            @csrf
            <button class="main-button">休憩開始</button>
        </form>
        <form action="/restEnd" method="post" class="main-item__form">
            @csrf
            <button class="main-button">休憩終了</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/atte.js') }}"></script>
@endsection