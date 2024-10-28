@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage_sell.css') }}">
@endsection

@section('content')
<div class="mypage-sell">
    <div class="mypage-sell__header">
        <h2>{{ $user->name }} 販売実績及び販売状況</h2>
    </div>
    <div class="mypage-sell_list">
        <table>
            <tr>
                <th>出品名</th>
                <th>価格</th>
                <th>販売状況</th>
                <th>購入者</th>
                <th>支払い方法</th>
                <th>支払い状況</th>
                <th>振込確認</th>
            </tr>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->purchase_status }}</td>
                <td>{{ $item->order_user}}</td>
                <td>{{ $item->payment_method }}</td>
                <td>{{ $item->order_status }}</td>
                <td>
                    <form action="" method="post">
                        <div>
                            <button type="submit">振込を確認</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
