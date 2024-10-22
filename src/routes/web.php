<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\StripePaymentsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{id}', [ItemController::class, 'detail']);

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/sell', [SellController::class, 'sell_index']);
    Route::post('/sell/create', [SellController::class, 'sell_create']);
    Route::get('/sell/items', [SellController::class, 'sell_items']);
    Route::post('/purchase/address',[PurchaseController::class,'purchase_address']);
    Route::post('/purchase/address/update',[PurchaseController::class,'purchase_address_update']);
    Route::get('/mypage/purchase/items',[PurchaseController::class,'purchase_items']);
    Route::post('/purchase/payment_method/update',[PurchaseController::class,'purchase_method_update']);
    Route::post('/purchase/create',[PurchaseController::class,'purchase_create']);
    Route::get('/mypage', [UserController::class,'mypage']);
    Route::post('/mypage/profile', [UserController::class,'mypage_profile']);
    Route::post('/mypage/profile/update', [UserController::class,'mypage_update']);
    Route::get('/item/favorite/search/mylist', [FavoriteItemController::class,'favorite_search']);
    Route::post('/item/favorite/update', [FavoriteItemController::class,'favorite']);
    Route::post('/item/comment', [CommentController::class,'comment_index']);
    Route::post('/item/comment/create', [CommentController::class,'comment_create']);
    Route::post('/item/stripe', [StripePaymentsController::class,'stripe_index']);
    Route::post('/item/stripe/payment', [StripePaymentsController::class,'stripe_payment']);
    Route::post('/item/stripe/complete', [StripePaymentsController::class,'stripe_complete']);
    Route::get('/purchase/{id}', [PurchaseController::class, 'purchase_index']);
});

Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/admin', [AdminController::class, 'admin_index']);
    Route::get('/admin/user', [AdminController::class, 'admin_user']);
    Route::post('/admin/user/delete', [AdminController::class, 'admin_user_delete']);
    Route::get('/admin/comment', [AdminController::class, 'admin_comment']);
    Route::post('/admin/comment/delete', [AdminController::class, 'admin_comment_delete']);
    Route::post('/admin/announcement', [AnnouncementController::class, 'AnnouncementMail']);
    Route::post('/admin/announcement/send', [AnnouncementController::class, 'AnnouncementMail_send']);
});

//会員登録後のメール認証処理
Route::get('/email/verify', function(){
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/'); // 認証後のリダイレクト先を指定
})->middleware(['auth', 'signed'])->name('verification.verify');

// メール認証通知の再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');