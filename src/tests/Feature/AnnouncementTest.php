<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class AnnouncementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     * 
     */
    public function it_sends_annoucement_emails()
    {
        //モックの設定
        Mail::fake();
        //テストユーザーを作成
        $users = User::all();

        //管理者ユーザーを作成してログイン状態にする
        $adminUser = User::find(1);

        //actingAsでﾛｸﾞｲﾝ
        $this->actingAs($adminUser);

        //フォームデータ
        $formData = [
            'subject' => 'Test Subject',
            'content' => 'Test Content',
            'user_ids' => $users->pluck('id')->toArray(),
        ];

        //POSTリクエストを送信
        $response = $this->post('/admin/announcement/send', $formData);

        //正しくリダイレクトされたかを確認
        $response->assertRedirect('/admin');

        //ﾒｰﾙが送信されたかを確認(送信ユーザー数に基づいて調整)
        Mail::assertSent(SendMail::class, count($users));
    }
}
