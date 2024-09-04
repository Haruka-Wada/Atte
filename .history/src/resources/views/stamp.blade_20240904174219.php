@extends('layout/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nav__item"><button class="header-nav__button">HOME</button></li>
    <li class="header-nav__item"><button>日付一覧</button></li>
    <li class="header-nav__item">
        <form action="#">
            @csrf
            <button class="header-nav__button">ログアウト</button>
        </form>
    </li>
</ul>
@endsection