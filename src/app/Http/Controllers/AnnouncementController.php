<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;

class AnnouncementController extends Controller
{
    public function AnnouncementMail(Request $request){
        $user_ids = $request->input('selected_users');

        if($user_ids){
            $users = User::whereIn('id', $user_ids)->get();
        }

        return view('admin.announcement', compact('users')); 
    }

    public function AnnouncementMail_send(Request $request){
        $subject = $request->input('subject');
        $content = $request->input('content');
        $userIds = $request->input('user_ids');

        if($userIds){
            //選択されたユーザー情報を取得
            $users = User::whereIn('id', $userIds)->get();

            //選択されたユーザーにメールを送信する
            foreach($users as $user){
                Mail::to($user->email)->send(new SendMail($subject, $content, $user));
            }
        }
        return redirect('/admin');
    }
}
