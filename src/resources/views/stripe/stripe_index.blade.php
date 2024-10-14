@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/stripe_index.css') }}">
@endsection

@section('content')
<div class="payment-container">
    <div class="payment-header">
        <h2>支払い画面</h2>
    </div>
    <div class="payment-info">
        <div class="payment-details">
            <h3 class="payment-title">支払い情報</h3>
            <table class="payment-table">
                <tr>
                    <th>購入品名</th>
                    <td>{{ $item->item_name }}</td>
                </tr>
                <tr>
                    <th>支払い金額</th>
                    <td>{{ $item->price }} 円</td>
                </tr>
            </table>
        </div>
        <div class="payment-section">
            <h3 class="payment-section-title">カード情報入力フォーム</h3>
            <form action="/item/stripe/payment" method="post" id="payment-form" class="payment-form">
                @csrf
                <input type="hidden" name="amount" value="{{ $item->price }}">
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <div id="card-element" class="payment-card-element"></div>
                <button type="submit" class="payment-button">支払い</button>
            </form>
        </div>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();
            
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');
            
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                stripe.createToken(cardElement).then(function(result) {
                    if (result.error) {
                        console.error(result.error.message);
                    } else {
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);
                        form.submit();
                    }
                });
            });
        </script>
    </div>
</div>
@endsection
