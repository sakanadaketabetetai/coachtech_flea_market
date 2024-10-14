@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase_bank_complete.css') }}">
@endsection

@section('content')
<div class="purchase_bank_complete_content">
    <div class="purchase_bank_complete_content-inner">
        <h2 class="purchase_bank_complete_content-text">ご予約ありがとうございます</h2>
    </div>
    <form action="/" method="get">
        @csrf
        <div class="purchase_bank_complete_button">
            <button class="purchase_bank_complete_button-submit">戻る</button>
        </div>
    </form>
</div>
@endsection