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
            <input type="text" name="name" placeholder="名前">
            <input type="text" name="email" placeholder="メールアドレス">
            <input type="text" name="password" placeholder="パスワード">
            <input type="text" name="">
        </form>
    </div>
</div>
@endsection