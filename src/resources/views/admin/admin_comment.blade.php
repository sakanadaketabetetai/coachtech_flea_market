@extends('layouts.admin_layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_comment.css') }}">
@endsection

@section('content')
<div class="admin-comment">
    <div class="admin-comment__container">
        <table class="admin-comment__table">
            <tr>
                <th>ユーザー名</th>
                <th>商品名</th>
                <th>コメント内容</th>
                <th>削除</th>
            </tr>
            @foreach($comments as $comment)
            <tr>
                <td>
                    {{ $comment->user_name }}
                </td>
                <td>
                    {{ $comment->item_name }}
                </td>
                <td>
                    {{ $comment->comment }}
                </td>
                <td>
                    <form action="/admin/comment/delete" method="post" class="admin-comment__form">
                        @csrf
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <div>
                            <button type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="admin-comment__pagination">
            {{ $comments->links() }}
        </div>
    </div>
</div>
@endsection
