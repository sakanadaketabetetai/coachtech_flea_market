<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_index(){
        return view('admin.admin');
    }

    public function admin_user(){
        $users = User::all();
        foreach($users as $user){
            $profile = Profile::find($user->id);
            $user->user_image = $profile->user_image;
            $user->post_code = $profile->post_code;
            $user->address = $profile->address;
            $user->building = $profile->building;
        }
        return view('admin.admin_user', compact('users'));
    }

    public function admin_user_delete(Request $request){
        $user = User::find($request->user_id)->delete();
        $profile = Profile::where('user_id', $request->user_id)->delete();
        return redirect('/admin/user');
    }

    public function admin_comment(){
        $comments = Comment::paginate(10);
        foreach($comments as $comment){

            $user = User::find($comment->user_id);
            $item = Item::find($comment->item_id);
            if($user){
                $comment->user_name = $user->name;
            }
            if($item){
                $comment->item_name = $item->item_name;
            }
        }
        return view('admin.admin_comment', compact('comments'));
    }

    public function admin_comment_delete(Request $request){
        $comment = Comment::find($request->comment_id)->delete();
        return redirect('/admin/comment');
    }
}
