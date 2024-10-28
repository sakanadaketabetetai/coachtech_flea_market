<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Condition;
use App\Models\FavoriteItem;

class ItemController extends Controller
{
    public function index(){
        $items = Item::all();

        //検索結果のデフォルトをおすすめ(all_items)に設定
        $search = "all_items";
        return view('index', compact(['items', 'search']));
    }

    public function detail($id){
        $item = Item::find($id);
        $category = Category::find($id);
        $condition = Condition::find($id);
        $favorite_items_count = FavoriteItem::where('item_id', $id)->count();
        $comments_count = Comment::where('item_id', $id)->count();

        return view('item_detail', compact(['item', 'favorite_items_count', 'comments_count','category','condition']));
    }

    public function item_search(Request $request){
        //クエリビルダを使って検索条件を設定します
        $query = Item::query();
        if ($request->filled('keyword')){
            $keyword = $request->input('keyword');
            $query->where('item_name', 'LIKE', "%{$keyword}%");
        }
        $items = $query->get();

        $search = "all_items";
        return view('index', compact(['items', 'search']));
    }
}
