@extends('layout/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp') }}">
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nab__item"><a href="/">HOME</a></li>
    <li class="header-nab__item"><a href="#">日付一覧</a></li>
    <li class="header-nab__item">
        <form action="#">
            @csrf
            <button header-></button>
        </form>
    </li>
</ul>