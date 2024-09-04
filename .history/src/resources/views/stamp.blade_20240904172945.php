@extends('layout/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp') }}">
@endsection

@section('nav')
<ul class="header-nav">
    <li><a href="/">HOME</a></li>
    <li><a href="#">日付一覧</a></li>
    <li>
        <form action="#">
        @csrf
        <button></button>
        </form></li>
</ul>
