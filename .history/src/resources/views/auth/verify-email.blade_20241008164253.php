@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">
@endsection

@section('main')
<div class="mail-text">
    ご登録ありがとうございます！<br>
    ご入力いただいたメールアドレスへ認証リンクを送信しましたので、クリックして認証を完了させてください。<br>
    もし、認証メールが届かない場合は再送させていただきます。
</div>

@if (session('status') == 'verification-link-sent')
<div class="mail-message">
    新しい認証メールが送信されました。
</div>
@endif

<div class="mail-box">
    <form method="POST" action="/email/verification-notification">
        @csrf
        <div>
            <button class="mail-button" type="submit">
                認証メールを再送する
            </button>
        </div>
    </form>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit" class="logout-button">
            ログアウト
        </button>
    </form>
</div>
@endsection