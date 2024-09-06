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
            <input type="text" class="main-form__input" name="name" placeholder="名前">
            <input type="text" class="main-form__input" name="email" placeholder="メールアドレス">
            <input type="text" class="main-form__input" name="password" placeholder="パスワード">
            <input type="text" class="main-form__input" name="password_confirmation" placeholder="確認用パスワード">
            <button>会員登録</button>
        </form>
    </div>
    <div class="main-"></div>
</div>
@endsection