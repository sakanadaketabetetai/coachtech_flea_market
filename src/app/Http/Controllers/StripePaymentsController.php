<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Stripe\Customer;
use Stripe\Charge;
use Exception;
use App\Models\Item;
use App\Models\Order;
use App\Models\SoldItem;

class StripePaymentsController extends Controller
{
    public function stripe_index(Request $request){
        $item = Item::find($request->item_id);
        return view('stripe.stripe_index', compact('item'));
    }

    //クレジットカードでの決済
    public function stripe_payment(Request $request){
        $item = Item::findorFail($request->item_id);
        $user_id = Auth::id();

        try{
            //Stripe APIキーを設定
            Stripe::setApiKey(env('STRIPE_SECRET'));

            //Stripeトークンを取得
            $token = $request->input('stripeToken');

            $customer = Customer::create([
                'email' => $request->user()->email,
                'source' => $token  //トークンを使って支払いソースを指定
            ]);

            //チャージを作成
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => (int) $request->input('amount'),
                'currency' => 'jpy', //通貨(日本)
            ]);

            $order = Order::create([
                'item_id' => $item->id,
                'user_id' => $user_id,
                'order_status' => 'paid',
                'payment_method' => 'credit_card',
                'amount' => $request->amount
            ]);

            SoldItem::create([
                'item_id' => $item->id,
                'user_id' => $user_id,
            ]);

            //Itemテーブルの販売状況を保存
            $item->status = '売約済';
            $item->save();

            return view('stripe.stripe_complete');
        } catch (\Exception $e){
            return back()->withErrors(['message' => '支払いに失敗しました: ']);
        }
    }
}
