@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase_convenience_complete.css') }}">
@endsection

@section('content')
<div class="convenience-complete">
    <div class="convenience-complete__inner">
        <h2 class="convenience-complete__text">ご予約ありがとうございます</h2>
        <p class="convenience-complete__message">
            ご注文が完了しました。<br>
            コンビニでのお支払いが確認され次第、発送手続きを進めさせていただきます。
        </p>
        <form action="/" method="get">
            @csrf
            <div class="convenience-complete__button">
                <button type="submit" class="convenience-complete__button-submit">トップページに戻る</button>
            </div>
        </form>
    </div>
</div>
@endsection
