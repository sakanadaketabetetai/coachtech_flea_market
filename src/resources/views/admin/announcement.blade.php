@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div>
    <h1>アナウンスメールの送信</h1>
    <form action="/admin/announcement/send" method="post">
        @csrf
        <div>
            <label for="users">送信先</label>
            <div id="users">
                @foreach($users as $user)
                    <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                    <span>{{ $user->name }}</span>
                @endforeach
            </div>
            <div>
                <label for="subject">件名</label>
                <input type="text" id="subject">
            </div>
            <div>
                <label for="content">内容</label>
                <textarea name="content" id="content"></textarea>
            </div>
            <div>
                <button type="submit">送信</button>
            </div>
        </div>
    </form>
</div>
@endsection