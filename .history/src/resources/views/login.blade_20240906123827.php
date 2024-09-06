@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('main')
<div class="main-container">
    <div class="main-title">
        <p class="main-title__text">ログイン</p>
    </div>
    <div class="main-form">
        <form action="">
            @csrf
            <input type="text" class="main-form__input" name="email" placeholder="メールアドレス">
            <input type="text" class="main-form__input" name="password" placeholder="パスワード">
            <button class="main-form__button">ログイン</button>
        </form>
    </div>
    <div class="main-login">
        <p>アカウントをお持ちでない方はこちらから</p>
        <a href="#">ログイン</a>
    </div>
</div>
@endsection