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
        <form action="/register" method="post">
            @csrf
            <input type="text" class="main-form__input" name="name" placeholder="名前" value="{{ old('name') }}">
            <input type="email" class="main-form__input" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            <input type="password" class="main-form__input" name="password" placeholder="パスワード">
            <input type="password" class="main-form__input" name="password_confirmation" placeholder="確認用パスワード">
            <button class="main-form__button">会員登録</button>
        </form>
    </div>
    <div class="main-login">
        <p>アカウントをお持ちの方はこちらから</p>
        <a href="#">ログイン</a>
    </div>
</div>
@endsection