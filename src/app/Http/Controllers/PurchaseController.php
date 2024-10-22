<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\SoldItem;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseCompleteMail;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function purchase_index($id){
        $user_id = Auth::id();
        $item = Item::find($id);
        $user = User::find($user_id);
        $profile = Profile::find($user_id);
        $purchase_method = session('payment_method', '未選択');
        return view('purchase.purchase_index', compact(['item', 'user', 'profile','purchase_method']));
    }

    public function purchase_address(Request $request){ 
        $user_id = Auth::id();
        $item = Item::find($request->item_id);
        $user_profile = Profile::where('user_id', $user_id);
        return view('purchase.purchase_address', compact(['user_profile','item']));
    }

    public function purchase_address_update(Request $request){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $item = Item::find($request->item_id);
        $profile = Profile::where('user_id', $user_id)->first();
        $purchase_method = session('payment_method', '未選択');

        //発送先を変更(profileのaddress,building,post_codeを編集)
        if($profile){
            $profile->post_code = $request->post_code;
            $profile->address = $request->address;
            $profile->building = $request->building;
            $profile->save();
        }

        return view('purchase.purchase_index', compact(['user', 'profile','item', 'purchase_method']));
    }

    public function purchase_items(Request $request){
        $user_id = $request->user_id;
        if( $user_id ){
            $purchase_item_ids = SoldItem::where('user_id', $user_id)->pluck('item_id');
            $items = Item::whereIn('id', $purchase_item_ids)->get();
        }
        $user = User::find($user_id);
        $user_image = Profile::where('user_id', $user_id)->value('user_image');
        return view('mypage.mypage', compact(['items','user','user_image']));
    }

    public function purchase_method_update(Request $request){
        session(['payment_method' => $request->payment_method]);
        return redirect('/purchase/' . $request->item_id);
    }

    public function purchase_create(Request $request){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $item = Item::find($request->item_id);

        //Orderテーブルに注文内容を保存
        Order::create([
            'user_id' => $user_id,
            'item_id' => $item->id,
            'payment_method' => $request->payment_method,
            'order_status' => 'pending',
            'amount' => $request->amount,
        ]);

        $order = Order::where('user_id', $user_id)
                        ->where('item_id', $item->id)
                        ->first();

        Mail::to($user->email)->send(new PurchaseCompleteMail($order, $user, $item));

        if( $request->payment_method == 'bank_transfer' ){
            return view('purchase.purchase_bank_complete');
        } elseif ( $request->payment_method == 'convenience_store' ){
            return view('purchase.purchase_convenience_complete');
        }
    }
}
