@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_address.css')}}">
@endsection

@section('content')
<div class="purchase-address">
    <div class="purchase-address__header">
        <h2>住所の変更</h2>
    </div>

    <div class="purchase-address__form-container">
        <form action="/purchase/address/update" method="post" class="purchase-address__form">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">

            <div class="form-group">
                <label for="post_code" class="form-label">郵便番号</label>
                <input type="text" name="post_code" id="post_code" class="form-input">
            </div>

            <div class="form-group">
                <label for="address" class="form-label">住所</label>
                <input type="text" name="address" id="address" class="form-input">
            </div>

            <div class="form-group">
                <label for="building" class="form-label">建物名</label>
                <input type="text" name="building" id="building" class="form-input">
            </div>

            <div class="form-group form-group--submit">
                <button type="submit" class="submit-button">更新する</button>
            </div>
        </form>
    </div>
</div>

@endsection