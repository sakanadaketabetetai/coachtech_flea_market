@extends('layouts.app') 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase_index.css') }}">
@endsection

@section('content')
<div class="purchase-index">
    <div class="purchase-index__left">
        <div class="purchase-index__item">
            <div class="purchase-index__item-details">
                <div class="purchase-index__item-image">
                    <img src="{{ $item->item_image }}" alt="商品画像">
                </div>
                <div class="purchase-index__item-info">
                    <h3 class="purchase-index__item-name">{{ $item->item_name }}</h3>
                    <p class="purchase-index__item-price">￥{{ $item->price }}</p>
                </div>
            </div>
        </div>
 
        <div class="purchase-index__payment-delivery">
            <div class="purchase-index__payment">
                <h3 class="purchase-index__section-title">支払い方法</h3>
                <div class="purchase-index__payment-content">
                    <div class="purchase-index__payment-method">
                        @if( $purchase_method == "credit_card" )
                            <p value="{{ $purchase_method }}">クレジットカード支払い</p>
                        @elseif ($purchase_method == "bank_transfer")
                            <p value="{{ $purchase_method }}">銀行振込</p>
                        @else
                            <p value="{{ $purchase_method }}">コンビニ支払い</p>
                        @endif 
                    </div>              
                    <div class="purchase-index__payment-form">
                        <button class="purchase-index__change-button" id="openModal">変更する</button>
                        <div id="paymentModal" class="modal">
                            <div class="modal__content">
                                <span class="modal__close">&times;</span>
                                <h3>購入方法を選択</h3>
                                <form action="/purchase/payment_method/update" method="post">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <label class="modal__label">
                                        <input type="radio" name="payment_method" value="credit_card"> クレジットカード
                                    </label><br>
                                    <label class="modal__label">
                                        <input type="radio" name="payment_method" value="bank_transfer"> 銀行振込
                                    </label><br>
                                    <label class="modal__label">
                                        <input type="radio" name="payment_method" value="convenience_store"> コンビニ支払い
                                    </label><br>
                                    <button type="submit" class="modal__save-button">決定</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="purchase-index__delivery">
                <h3 class="purchase-index__section-title">配送先</h3>
                <div class="purchase-index__address-content">
                    <table class="purchase-index__delivery-table">
                        <tr>
                            <th>発送先氏名</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>郵便番号</th>
                            <td>{{ $profile->post_code }}</td>
                        </tr>
                        <tr>
                            <th>発送先住所</th>
                            <td>{{ $profile->address }}</td>
                        </tr>
                        <tr>
                            <th>建物名</th>
                            <td>{{ $profile->building }}</td>
                        </tr>
                    </table>
                    <form action="/purchase/address" method="post">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button class="purchase-index__change-button">変更する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="purchase-index__summary">
        <form action="
            @if($purchase_method == 'credit_card')
                /item/stripe
            @else
                /purchase/create
            @endif
            " method="post">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <input type="hidden" name="amount" value="{{ $item->price }}">
            <table class="purchase-index__summary-table">
                <tr>
                    <th>商品代金</th>
                    <td>￥{{ $item->price }}</td>
                </tr>
                <tr>
                    <th>支払い金額</th>
                    <td>￥{{ $item->price }}</td>
                </tr>
                <tr>
                    <th>支払い方法</th>
                    @if( $purchase_method == "credit_card" )
                        <td>クレジットカード支払い</td>
                        <input type="hidden" name="payment_method" value="credit_card">
                    @elseif ($purchase_method == "bank_transfer")
                        <td>銀行振込</td>
                        <input type="hidden" name="payment_method" value="bank_transfer">
                    @else
                        <td>コンビニ支払い</td>
                        <input type="hidden" name="payment_method" value="convenience_store">
                    @endif
                </tr>
            </table>
            <div class="purchase-index__summary-button">
                <button type="submit" class="purchase-index__summary-button-submit" >購入する</button>
            </div>
        </form>
    </div>
</div>

<script>
const modal = document.getElementById("paymentModal");
const btn = document.getElementById("openModal");
const span = document.getElementsByClassName("modal__close")[0];

btn.onclick = function() {
    modal.style.display = "block";
};

span.onclick = function() {
    modal.style.display = "none";
};

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
</script>
@endsection
