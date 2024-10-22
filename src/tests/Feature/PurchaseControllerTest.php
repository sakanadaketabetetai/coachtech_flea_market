<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use App\Models\Profile;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseCompleteMail;
use Illuminate\Support\Facades\Cache;


class PurchaseControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     * @group purchase
     */
    public function test_purchase_address_update()
    {
        //テストユーザー及びプロフィールを作成
        $user = User::create([
            'name' => '社長',
            'email' => 'test1@example.com',
            'password' => bcrypt('president12345'),
            'email_verified_at' => now()
        ]);
        //テスト準備としてプロフィールの初期値を作成
        Profile::create([
            'user_id' => $user->id,
            'post_code' => '1234567',
            'address' => '東京',
            'building' => '東京タワー'
        ]);

        //作成したテストユーザーでログイン処理
        $this->actingAs($user);

        //プロフィールの初期値がデータベースに保存されているか確認する
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'post_code' => '1234567',
            'address' => '東京',
            'building' => '東京タワー'
        ]);

        //住所変更機能確認
        $this->post('/purchase/address/update', [
            'user_id' => $user->id,
            'post_code' => '7654321',
            'address' => '京都',
            'building' => '京都タワー'
        ]);

        //住所が変更されているか確認
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'post_code' => '7654321',
            'address' => '京都',
            'building' => '京都タワー'
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @test
     * @group purchase 
     * 
     */

    public function test_purchase_create(){
        //テストユーザー及びプロフィールを作成
        $user = User::create([
            'name' => '社長',
            'email' => 'test1@example.com',
            'password' => bcrypt('president12345'),
            'email_verified_at' => now()
        ]);
        //作成したテストユーザーでログイン処理
        $this->actingAs($user);

        //Itemテーブルにテスト用を作成する
        /// コンディションとカテゴリーデータを作成
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
        /// ファイルシステムをモックし、実際に保存しないように処理
        Storage::fake('public');

        /// 既存の画像をモックストレージにコピー
        $existingImagePath = storage_path('app/public/images/logo.svg');

        /// モックストレージにファイルをコピーしてからテストに使用
        $mockImagePath = 'images/logo.svg';
        Storage::disk('public')->put($mockImagePath, file_get_contents($existingImagePath));

        /// コピーされたファイルをテストで使用
        $uploadedFile = new UploadedFile($existingImagePath, 'logo.svg', null, null, true);

        /// テスト用Itemを作成
        $response = $this->post('/sell/create', [
            'item_name' => 'Test Item',
            'price' => 1000,
            'description' => 'A great item',
            'condition_id' => 1,
            'category_id' => 1,
            'image' => $uploadedFile /// 既存の画像を使用
        ]);
        /// テスト用Itemデータが保存されているか確認
        $this->assertDatabaseHas('items', ['item_name' => 'Test Item']);
        $this->assertDatabaseHas('category_items', ['category_id' => 1]);

        $test_item = Item::find(1);


        //purchase_createのテスト
        Order::create([
            'user_id' => $user->id,
            'item_id' => $test_item->id,
            'payment_method' => 'bank_transfer',
            'order_status' => 'pending',
            'amount' => 1000,
        ]);

        $order = Order::where('user_id', $user->id)
        ->where('item_id', $test_item->id)
        ->first();

        Mail::to($user->email)->send(new PurchaseCompleteMail($order, $user, $test_item));
    }
    public function setUp(): void
    {
        parent::setUp();
        Cache::flush(); // キャッシュのクリア
    }
}
