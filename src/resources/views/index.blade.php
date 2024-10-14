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
                <div>
                    <input type="hidden" name="user_id" value="">
                    <input type="hidden" name="search" value="all_items">
                    @if($search == "all_items")
                        <button class="item-list__button-select" type="submit" >おすすめ</button>
                    @else
                        <button class="item-list__button" type="submit" >おすすめ</button>
                    @endif
                </div>
            </form>
            <form action="/item/favorite/search/mylist" method="get">
                @csrf
                <div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="search" value="my_favorite">
                    @if($search == "my_favorite")
                        <button class="item-list__button-select" type="submit" >マイリスト</button>
                    @else
                        <button class="item-list__button" type="submit" >マイリスト</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="item-list__items">
        @foreach( $items as $item )
        <div class="item-card">
            <form action="/item/{{ $item->id }}" method="get">
                @csrf
                <div class="item-card__image">
                    <button type="submit" class="item-card__image-button">
                        <img src="{{ $item->item_image }}" alt="item image" class="item-card__image-img">
                    </button>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection