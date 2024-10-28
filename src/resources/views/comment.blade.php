@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}"> 
@endsection

@section('content')
<div class="comment-page">
    <div class="comment-page__item">
        <img class="comment-page__item-image" src="{{ $item->item_image }}" alt="商品画像">
    </div>

    <div class="comment-page__item-details">
        <div class="item-details">
            <h3 class="item-details__name">{{ $item->item_name }}</h3>
            <h4 class="item-details__price">￥{{ $item->price }} 円</h4>
        </div>
        <div class="item-actions">
            <div class="item-actions__favorite">
                <form action="/item/favorite/update" method="post">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button class="favorite-button" type="submit">★</button>
                    <div class="favorite-count">{{ $favorite_items_count }}</div>
                </form>
            </div>
            <div class="item-actions__comment">
                <p class="comment-button">💭</p>
                <div class="comment-count">{{ $comments_count }}</div>
            </div>
        </div>

        <div class="comment-list">
            @foreach($comments as $comment)
            <div class="comment">
                <div class="comment__user-info">
                    <img class="comment__user-image" src="{{ $comment->user_image }}" alt="ユーザーの画像">
                    <label class="comment__user-name">{{ $comment->user_name }}</label>
                </div>
                <div class="comment__content">
                    <p>{{ $comment->comment }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="comment-form">
            <form action="/item/comment/create" method="post">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <label class="comment-form__label">商品へのコメント</label>
                <textarea class="comment-form__textarea" name="comment"></textarea>
                <div>
                    <button class="comment-form__submit">コメントを送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
