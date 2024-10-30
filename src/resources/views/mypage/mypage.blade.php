@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="mypage__header">
        <div class="mypage__header-left">
            <div class="mypage__image">
                <img src="{{ $user_image }}" alt="ユーザー画像">
            </div>
            <div class="mypage__name">
                <h2>{{ $user->name }}</h2>
            </div>
        </div>
        <div class="mypage__header-right">
            <div class="mypage__profile-edit">
                <form action="/mypage/profile" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button class="mypage__edit-button">プロフィール編集</button>
                </form>
            </div>
            <div class="mypage__profile-edit">
                <form action="/mypage/sell" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button class="mypage__edit-button">販売実績及び販売状況</button>
                </form>
            </div>
            @role('admin') 
            <div class="mypage__profile-edit">
                <a href="/admin" class="mypage__edit-button">管理画面</a> 
            </div>
            @endrole
        </div>
    </div>
    <div class="mypage__actions">
        <div class="mypage__action-buttons"> 
            <form action="/sell/items" method="get">
                @csrf
                <div>
                    <input type="hidden" name="user_id" value=" {{ $user->id }}">
                    <input type="hidden" name="search" value="sell_items">
                    @if($search == "sell_items" )
                        <button class="mypage__button-select" type="submit">出品した商品</button>
                    @else   
                        <button class="mypage__button" type="submit">出品した商品</button>    
                    @endif
                </div>
            </form>
            <form action="/mypage/purchase/items" method="get">
                @csrf
                <div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="search" value="purchase_items">
                    @if($search == "purchase_items")
                        <button class="mypage__button-select" type="submit">購入した商品</button>
                    @else
                        <button class="mypage__button" type="submit">購入した商品</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="mypage__items">
        @foreach($items as $item)
        <div class="mypage__item">
            <form action="/item/{{ $item->id }}" method="get">
                @csrf
                <div>
                    <button class="mypage__item-button">
                        <img src="{{ $item->item_image }}" alt="商品画像">
                    </button>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
