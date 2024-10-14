<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;

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

        return view('mypage.mypage', compact(['user','items','user_image']));
    }

    public function mypage_profile(Request $request){
        $profile = Profile::where('user_id', $request->id)->first();
        $user = User::find($request->id); 
        return view('mypage.profile', compact('profile','user'));
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

        return view('mypage.mypage', compact(['user','items','user_image']));
    }
}
