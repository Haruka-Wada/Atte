@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_attendance.css') }}">
@endsection

@section('main')
<div class="main-container">
    <div class="main-message">
        <p>{{ $user->name }}さんの勤務一覧表</p>
    </div>
    <table class="main-table">
        <tr>
            <th>日付</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>

        @isset($works)
        @foreach($works as $work)
        <tr>
            <td>{{ $work->start_time->format('Y-m-d') }}</td>
            <td>{{ $work->start_time->format('H:i:s') }}</td>
            <td>{{ $work->end_time ? $work->end_time->format('H:i:s') : '' }}</td>
            <td>{{ $work->rest_time ? $work->rest_time->format('H:i:s') : '' }}</td>
            <td>{{ $work->work_time ? $work->work_time->format('H:i:s') : '' }}</td>
        </tr>
        @endforeach
        @endisset
    </table>
    <div class="main-pagination">
        {{ $works->appends(request()->query())->links() }}
    </div>
</div>

@endsection