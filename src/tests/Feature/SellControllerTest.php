<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Condition;
use App\Models\Category;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;
use Illuminate\Support\Facades\Cache;

class SellControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Cache::flush(); // キャッシュのクリア
    }

    /**
     * A basic feature test example.
     *
     * @test
     * @group sell
     * 
     */
    public function test_it_create_a_new_item()
    {
        // 管理者権限を持つユーザーを作成する
        ///ユーザーを作成
        $adminUser = User::create([
                'name'=> '社長',
                'email'=> 'test1@example.com',
                'password'=> bcrypt('president12345'),
                'email_verified_at' => now(), 
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

        // コンディションとカテゴリーデータを作成
        $conditions = Condition::insert([
            ['condition' => '新品/未使用'],
            ['condition' => '未使用に近い'],
            ['condition' => '目立った傷や汚れなし'],
            ['condition' => '屋や傷や汚れあり'],
            ['condition' => '傷や汚れあり'],
            ['condition' => 'ジャンク品'],
        ]);

        $categories = Category::insert([
            ['name' => 'レディース'],
            ['name' => 'メンズ'],
            ['name' => 'キッズ・ベビー'],
            ['name' => 'スマートフォン・携帯電話'],
            ['name' => 'パソコン・タブレット'],
            ['name' => '本'],
            ['name' => 'フィギュア'],
            ['name' => '家具'],
            ['name' => 'スキンケア'],
            ['name' => 'スポーツ用品'],
            ['name' => '自動車パーツ'],
            ['name' => 'お菓子'],
            ['name' => 'ペット用品'],
            ['name' => 'その他'],
        ]);

        // ファイルシステムをモックし、実際に保存しないように処理
        Storage::fake('public');

        // 既存の画像をモックストレージにコピー
        $existingImagePath = storage_path('app/public/images/logo.svg');

        // モックストレージにファイルをコピーしてからテストに使用
        $mockImagePath = 'images/logo.svg';
        Storage::disk('public')->put($mockImagePath, file_get_contents($existingImagePath));

        // コピーされたファイルをテストで使用
        $uploadedFile = new UploadedFile($existingImagePath, 'logo.svg', null, null, true);

        $response = $this->post('/sell/create', [
            'item_name' => 'Test Item',
            'price' => 1000,
            'description' => 'A great item',
            'condition_id' => 1,
            'category_id' => 1,
            'image' => $uploadedFile // 既存の画像を使用
        ]);

        // ステータスコード確認
        $response->assertStatus(200);

        // データベース確認
        $this->assertDatabaseHas('items', ['item_name' => 'Test Item']);
        $this->assertDatabaseHas('category_items', ['category_id' => 1]);

        // 画像がモックストレージに正しく保存されているか確認
        Storage::disk('public')->assertExists('images/logo.svg');
    }
}
