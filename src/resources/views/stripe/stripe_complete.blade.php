@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/stripe_complete.css') }}">
@endsection

@section('content')
<div class="payment">
    <div class="payment__header">
        <a href="/mypage/{{ Auth::id() }}" class="payment__header-back">
            <span class="payment__back-icon">&lt;</span> My Page
        </a>
    </div>

    <div class="payment__container">
        <div class="payment__content">
            <h1 class="payment__title">Thank You!</h1>
            <p class="payment__message">Your payment has been successfully completed.</p>
            <div class="payment__icon-container">
                <i class="payment__icon">&#10003;</i>
            </div>
            <a href="/" class="payment__home-link">Return to Home</a>
        </div>
    </div>
</div>
@endsection
