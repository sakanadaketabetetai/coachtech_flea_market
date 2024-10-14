<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteItem;
use App\Models\Item;

class FavoriteItemController extends Controller
{
    public function favorite_search(Request $request){
        $user_id = $request->user_id;
        if( !$user_id ){
            $items = Item::all();
        } else{
            $favorite_item_ids = FavoriteItem::where('user_id', $user_id)->pluck('item_id');
            $items = Item::whereIn('id', $favorite_item_ids)->get();
        }
        
        //検索状態を変数に格納　おすすめ(all_items)　か マイリスト(my_favorite)か判断
        $search = $request->search;

        return view('index', compact(['items', 'search']));
    }

    public function favorite(Request $request){
        $user_id = Auth::id();
        $favorite = FavoriteItem::where('user_id', $user_id)
                            ->where('item_id', $request->item_id)
                            ->first();
        $item_id = $request->item_id;

        //お気に入り登録及び登録解除処理
        if(!$favorite){
            FavoriteItem::create([
                'user_id' => $user_id,
                'item_id' => $request->item_id
            ]);
        } else {
            $favorite->delete();
        }
        return redirect('/item/' . $item_id);
    }
}
