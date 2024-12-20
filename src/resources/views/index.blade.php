@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection
 
@section('content')
<div class="item-list">
    <div class="item-list__filters">
        <div class="item-list__filters-buttons"> 
            <form action="/item/favorite/search/mylist" method="get">
                @csrf
                <div class="item-list__button">
                    <input type="hidden" name="user_id" value="">
                    <input type="hidden" name="search" value="all_items">
                    @if($search == "all_items")
                        <button class="item-list__button-submit-select" type="submit" >おすすめ</button>
                    @else
                        <button class="item-list__button-submit" type="submit" >おすすめ</button>
                    @endif
                </div>
            </form>
            <form action="/item/favorite/search/mylist" method="get">
                @csrf
                <div class="item-list__button">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="search" value="my_favorite">
                    @if($search == "my_favorite")
                        <button class="item-list__button-submit-select" type="submit" >マイリスト</button>
                    @else
                        <button class="item-list__button-submit" type="submit" >マイリスト</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="item-list__items">
        @foreach( $items as $item )
        <a href="/item/{{ $item->id }}">         
            <div class="item-card__image">
                <img src="{{ $item->item_image }}" alt="item image" class="item-card__image-img">
                <div class="item-list__priceContainer">
                    <span class="item-list__price">￥{{ $item->price }}</span>
                </div>
                @if ($item->status == "売約済")
                <div class="item-list__">
                    <span class="item-list__soldout">Sold Out</span>
                </div>
                @endif
            </div>
        </a>        
        @endforeach
    </div>
</div>
@endsection