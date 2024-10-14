<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Profile;
use App\Models\FavoriteItem;
use App\Models\User;

class CommentController extends Controller
{
    public function comment_index(Request $request){
        $item = Item::find($request->item_id);
        $comments = Comment::where('item_id', $request->item_id)->get();
        $favorite_items_count = FavoriteItem::where('item_id', $request->item_id)->count();
        $comments_count = Comment::where('item_id', $request->item_id)->count();

        foreach ($comments as $comment){
            $user_profile = Profile::where('user_id', $comment->user_id)->first();
            $comment->user_image = $user_profile->user_image;
            $comment->user_name = User::where('id', $comment->user_id)->value('name');
        }
        return view('comment', compact(['item', 'comments','favorite_items_count','comments_count']));
    }

    public function comment_create(Request $request){
        $user_id = Auth::id();
        $item_id = $request->item_id;
        $comment = Comment::where('user_id', $user_id)
                            ->where('item_id', $item_id)
                            ->first();
        if(!$comment){
            Comment::create([
                'user_id' => $user_id,
                'item_id' => $item_id,
                'comment' => $request->comment
            ]);
        }
        return redirect('/item/' . $item_id);
    }
}
