@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('main')
<div class="main-container">
    <div class="main-title">
        <p class="main-title__text">会員登録</p>
    </div>
    <div class="main-form">
        <form action="">
            @csrf
            <input type="text">
        </form>
    </div>
</div>
@endsection