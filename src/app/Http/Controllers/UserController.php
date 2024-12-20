<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Order;
use App\Models\SoldItem;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    public function mypage(){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $items = Item::where('user_id', $user_id)->get();
        $user_image = Profile::where('user_id', $user_id)->value('user_image');
        if(is_null($user_image)){
            $user_image = "/storage/images/logo.svg";
        }

        $search = "sell_items";

        return view('mypage.mypage', compact(['user','items','user_image','search']));
    }

    public function mypage_profile(Request $request){
        $profile = Profile::where('user_id', $request->id)->first();
        $user = User::find($request->id); 
        $user_image = Profile::where('user_id', $request->id)->value('user_image');
        if(is_null($user_image)){
            $user_image = "/storage/images/logo.svg";
        }
        return view('mypage.profile', compact(['profile','user','user_image']));
    }

    public function mypage_update(Request $request){
        $profile = Profile::find($request->id);
        $user = User::find($profile->user_id);

        //$imagePathを既存のユーザー画像またはデフォルト値で初期化する
        $imagePath = $profile->user_image;

        //ユーザーの画像をstorage/app/public/imagesに保存して、保存先のパスを取得
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public'); //imagesフォルダに画像を
            $imagePath = Storage::url($path);
        }

        //プロフィール更新
        $profile->user_image = $imagePath;
        $profile->post_code = $request->post_code;
        $profile->address = $request->address;
        $profile->building = $request->building;
        $profile->save();

        //ユーザー名を更新
        $user->name = $request->name;
        $user->save();

        $items = Item::where('user_id', $user->id)->get();
        $user_image = Profile::where('user_id', $user->id)->value('user_image');

        if(is_null($user_image)){
            $user_image = "/storage/images/logo.svg";
        }

        $search = "sell_items";

        return view('mypage.mypage', compact(['user','items','user_image','search']));
    }

    public function mypage_sell(Request $request){
        $user = User::find($request->id);
        $items = Item::where('user_id', $user->id)->get();
        foreach($items as $item){
            $order = Order::where('item_id', $item->id)->first();
            $sold_item = SoldItem::where('item_id', $item->id)->first();
            if($order){
                $order_user = User::find($order->user_id);
                $item->order_user = $order_user->name;
                $item->payment_method = $order->payment_method;
                $item->order_status = $order->order_status;
            } elseif($sold_item){
                $order_user = User::find($order->user_id);
                $item->order_user = $order_user->name;
                $item->payment_method = $order->payment_method;
                $item->order_user = $order_user->name;
                $item->order_status = $order->order_status;
            }
        }
        return view('mypage.mypage_sell', compact(['user','items']));
    }

    public function mypage_sell_payment(Request $request){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $item = Item::find($request->item_id);

        //各テーブルへ注文情報の保存準備
        $order = Order::where('item_id', $item->id)->first();
        $order_user = User::find($order->user_id);

        //itemsテーブルの販売状況を保存
        $item->status = '売約済';
        $item->save();

        //ordersテーブルの支払い状況を保存
        $order->order_status = 'paid';
        $order->save();

        //sold_itemsテーブルに決済が完了した注文情報を保存
        SoldItem::create([
            'user_id' => $order_user->id,
            'item_id' => $item->id
        ]);

        //mypage_sell画面表示準備
        $items = Item::all();
        foreach($items as $item){
            $order = Order::where('item_id', $item->id)->first();
            $sold_item = SoldItem::where('item_id', $item->id)->first();
            if($order){
                $order_user = User::find($order->user_id);
                $item->order_user = $order_user->name;
                $item->payment_method = $order->payment_method;
                $item->order_status = $order->order_status;
            } elseif($sold_item){
                $order_user = User::find($order->user_id);
                $item->order_user = $order_user->name;
                $item->payment_method = $order->payment_method;
                $item->order_user = $order_user->name;
                $item->order_status = $order->order_status;
            }
        }
        return view('mypage.mypage_sell', compact(['user', 'items']));
    }
}
