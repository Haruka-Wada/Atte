@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nav__item"><button class="header-nav__button">ホーム</button></li>
    <li class="header-nav__item"><button class="header-nav__button">日付一覧</button></li>
    <li class="header-nav__item">
        <form action="#">
            @csrf
            <button class="header-nav__button">ログアウト</button>
        </form>
    </li>
</ul>
@endsection

@section('main')
<div class="main-container">
    <div class="main-date"></div>
</div>
@endsection