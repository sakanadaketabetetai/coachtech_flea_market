<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use App\Models\User;
use App\Mail\SendMail;
use App\Models\Profile;
use Illuminate\Support\Facades\Mail;

class AnnouncementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     * @group announcement
     */
    public function test_it_sends_annoucement_emails()
    {
        //モックの設定
        Mail::fake();
        //テストユーザーを作成
        $users = User::factory(3)->create();

        // 管理者権限を持つユーザーを作成する
        ///ユーザーを作成
        $adminUser = User::create([
            'name'=> '社長',
            'email'=> 'test1@example.com',
            'password'=> bcrypt('president12345'),
        ]);
        Profile::create([
            'user_id' => $adminUser->id
        ]);
        ///admin Roleを作成
        $adminRole = Role::create(['name' => 'admin']);
        ///権限を作成
        $registerPermission = Permission::create(['name' => 'register']);
        ///adminRoleにregister権限を付与
        $adminRole->givePermissionTo($registerPermission);
        ///adminUserにadminを割り当て
        $adminUser->assignRole($adminRole);

        //adminUserでログイン処理
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
