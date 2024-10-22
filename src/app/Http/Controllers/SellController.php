<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Item;
use App\Models\CategoryItem;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function sell_index(){
        $conditions = Condition::all();
        $categories = Category::all();
        return view('sell', compact(['conditions', 'categories']));
    }

    public function sell_create(Request $request){
        $user_id = Auth::id();
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public'); //imagesフォルダに画像を
            $imagePath = Storage::url($path);
        }

        // 商品情報を保存
        $item = Item::create([
            'item_name' => $request->item_name,
            'price' => $request->price,
            'description' => $request->description,
            'item_image' => $imagePath,
            'user_id' => $user_id,
            'category_item_id' => null, // 初期値をnullに設定
            'condition_id' => $request->condition_id,
        ]);

        // category_itemsテーブルに保存
        $categoryItem = CategoryItem::create([
            'item_id' => $item->id,
            'category_id' => $request->category_id,
        ]);

        // itemsテーブルのcategory_item_idを更新
        $item->category_item_id = $categoryItem->id; // 新しく作成したcategory_itemのIDを取得
        $item->save();

        $items = Item::all();

        //検索結果のデフォルトをおすすめ(all_items)に設定
        $search = "all_items";

        return view('index', compact(['items', 'search'])); 
    }

    public function sell_items(Request $request){
        $user_id = $request->user_id;
        if( $user_id ){
            $items = Item::where('user_id', $user_id)->get();
        }
        $user = User::find($user_id);
        $user_image = Profile::where('user_id', $user_id)->value('user_image');
        return view('mypage.mypage', compact(['items','user','user_image']));
    }
}
