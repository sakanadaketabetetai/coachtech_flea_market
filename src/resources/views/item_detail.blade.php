@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
@endsection

@section('content')
<div class="item-detail">
    <div class="item-detail__image-container">
        <img src="{{ $item->item_image }}" alt="商品画像" class="item-detail__image">
    </div>
    <div class="item-detail__info">
        <div class="item-detail__header">
            <h2 class="item-detail__name">商品名</h2> 
            <h3 class="item-detail__brand">{{ $item->item_name }}</h3>
        </div>
        <div class="item-detail__price">
            <h3>￥{{ $item->price }} 円</h3>
        </div>
        <div class="item-detail__actions">
            <div class="item-detail__favorite">
                <form action="/item/favorite/update" method="post">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button type="submit" class="item-detail__favorite-button">★</button>
                    <div class="item-detail__favorite-count">{{ $favorite_items_count }}</div>
                </form>
            </div>
            <div class="item-detail__comment">
                <form action="/item/comment" method="post">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button class="item-detail__comment-button">💭</button>
                    <div class="item-detail__comment-count">{{ $comments_count }}</div>
                </form>
            </div>
        </div>
        <div class="item-detail__purchase">
            <form action="/purchase/{{ $item->id }}" method="get">
                @csrf
                <button class="item-detail__purchase-button">購入する</button>
            </form>
        </div>
        <div class="item-detail__description">
            <h2>商品説明</h2>
            <div class="item-detail__description-text">
                {{ $item->description }}
            </div>
        </div>
        <div class="item-detail__condition">
            <h2>商品の状態</h2>
            <table class="item-detail__table">
                <tr>
                    <th>カテゴリー</th>
                    <td>
                        <div class="item-detail__category">
                            {{ $category->name }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>商品の状態</th>
                    <td>{{ $condition->condition }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
