@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase_bank_complete.css') }}">
@endsection

@section('content')
<div class="purchase-bank-complete">
    <div class="purchase-bank-complete__inner">
        <h2 class="purchase-bank-complete__text">ご予約ありがとうございます</h2>
        <p class="purchase-bank-complete__message">
            ご注文が完了し、振込情報が送信されました。<br>
            銀行振込が確認され次第、発送手続きを進めさせていただきます。
        </p>
        <form action="/" method="get">
            @csrf
            <div class="purchase-bank-complete__button">
                <button type="submit" class="purchase-bank-complete__button-submit">トップページに戻る</button>
            </div>
        </form>
    </div>
</div>
@endsection
