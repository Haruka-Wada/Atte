@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('main')
<div class="main-container">
    <table class="main-table">
        <tr>
            <th>名前</th>
            <th>登録日</th>
            <th></th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email_verified_at->format('Y-m-d') ? $user->email_verified_at->format('Y-m-d') : '認証待ち' }}</td>
            <td>
                <form action="/user/attendance" method="get">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button class="attendance-btn">勤務一覧</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection