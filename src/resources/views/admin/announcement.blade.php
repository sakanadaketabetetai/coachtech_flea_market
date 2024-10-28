@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/announcement.css') }}">k
@endsection

@section('content')
<div class="announcement-container">
    <h1 class="announcement-title">アナウンスメールの送信</h1>
    <form action="/admin/announcement/send" method="post" class="announcement-form">
        @csrf
        <div class="form-group">
            <label for="users" class="form-label">送信先</label>
            <div id="users" class="user-list">
                @foreach($users as $user)
                    <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                    <span class="user-name">{{ $user->name }}</span>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="subject" class="form-label">件名</label>
            <input type="text" id="subject" name="subject" class="form-input">
        </div>
        <div class="form-group">
            <label for="content" class="form-label">内容</label>
            <textarea name="content" id="content" class="form-textarea"></textarea>
        </div>
        <div class="form-button">
            <button type="submit" class="form-button-submit">送信</button>
        </div>
    </form>
</div>
@endsection
