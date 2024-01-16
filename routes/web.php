<?php
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\BidsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ClientItemController;
use App\Http\Controllers\Client\ClientAuthorController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\RechargeController;
use App\Http\Controllers\Client\Withdraw;
use App\Http\Controllers\Client\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::name('client.')->group(function () {
    Route::get('/explore/{id}',[ClientItemController::class,'detail'])->name('detail');
    Route::get('/collection/{id}',[ClientItemController::class,'collection'])->name('collection');
    Route::get('/author/{id}',[ClientAuthorController::class,'profile'])->name('profile');
    Route::get('/',[HomeController::class,'index'])->name('index');
    Route::get('/news',[HomeController::class,'news'])->name('news');
    Route::get('/explore',[ClientItemController::class,'explore'])->name('explore');
    Route::get('/author',[ClientAuthorController::class,'author'])->name('author');
    //-------------Read-notification-------------//
    Route::post('/read_nofitication',[NotificationController::class,'read_nofitication'])->name('read_nofitication');
    //-------------Update-notification-------------//
    Route::post('/update_nofitication',[NotificationController::class,'update_nofitication'])->name('update_nofitication');
    //-------------Follow&&Unfollow-------------//
    Route::post('/follow',[ClientController::class,'follow'])->name('follow');
    Route::post('/unfollow',[ClientController::class,'unfollow'])->name('unfollow');
    //-------------Filter Item-------------//
    Route::post('/filter_item',[ClientItemController::class,'filter_item'])->name('filter_item');
    //-------------Search--------------//
    Route::post('/search',[ClientItemController::class,'search'])->name('search');
    //-------------signup--------------//
    Route::get('/signup',[ClientController::class,'signup'])->name('signup');
    Route::post('/signup',[ClientController::class,'create_user'])->name('create_user');
    //---------accoutnt_info-----------//
    Route::get('/myaccount',[ClientController::class,'myaccount'])->middleware('check_login')->name('myaccount');
    Route::post('/myaccount',[ClientController::class,'account_update'])->middleware('check_login')->name('account_update');
    //---------bid_history-----------//
    Route::get('/bid_history',[HomeController::class,'bid_history'])->name('bid_history');
    //---------bid_now-----------//
    Route::post('/bid_now',[HomeController::class,'bid_now'])->middleware('check_login')->name('bid_now');
    Route::post('/bid_success',[HomeController::class,'bid_success'])->middleware('check_login')->name('bid_success');
    //------------upload-your-nft---------//
    Route::get('/uploadnft',[ClientController::class,'uploadnft'])->middleware('check_login')->name('uploadnft');
    Route::post('/uploadnft',[ClientController::class,'upload_item'])->middleware('check_login')->name('upload_item');
    //------------recharge-----------//
    Route::get('/recharge',[RechargeController::class,'recharge'])->middleware('check_login')->name('recharge');
    Route::get('/bill_check',[RechargeController::class,'bill_check'])->middleware('check_login')->name('bill_check');
    Route::get('/bill_success',[RechargeController::class,'bill_success'])->middleware('check_login')->name('bill_success');
    Route::get('/bill_error',[RechargeController::class,'bill_error'])->middleware('check_login')->name('bill_error');
    //------------withdraw------------//
    Route::get('/withdraw',[Withdraw::class,'withdraw'])->middleware('check_login')->name('withdraw');
    Route::post('/withdraw',[Withdraw::class,'withdraw_store'])->middleware('check_login')->name('withdraw_store');
    Route::get('/withdraw_success',[Withdraw::class,'withdraw_success'])->middleware('check_login')->name('withdraw_success');
    //------------getItem------------//
    Route::get('/get_item/{id}',[ClientItemController::class,'get_item'])->name('get_item');
});

//---------------VN_PAY--------------//
Route::post('/vn_payment',[RechargeController::class,'vn_payment'])->name('vn_payment');
//-------------Login-------------//
Route::get('/login',[LoginController::class,'showLogin'])->name('login');
Route::post('/login',[LoginController::class,'login']);
 //-------------Logout-------------//
Route::get('/logout',Logout::class)->name('logout');


// Route::prefix('admin')->name('admin.')->middleware('check_login')->group(function () {
Route::prefix('admin')->name('admin.')->middleware('check_admin')->group(function () {
    Route::get('dashboard',function() {
        return view('admin.dashboard');
    })->name('dashboard');
    

    Route::prefix('item')->name('item.')->controller(ItemController::class)->group(function () {
        Route::get('items_list', 'index')->name('items_list');
        Route::get('items_list/{id}', 'detail')->name('item_detail');
        Route::get('edit_item/{id}', 'edit')->name('edit_item');
        Route::post('edit_item/{id}', 'update')->name('update_item');
        Route::get('ban_item/{id}', 'ban')->name('ban_item');
        Route::post('item_filter', 'filter')->name('item_filter');
        Route::get('create_item', 'create')->name('create_item');
        Route::post('create_item', 'store')->name('store_item');
        Route::get('approve_item/{id}', 'approve')->name('approve_item');
    });

    Route::prefix('bid')->name('bid.')->controller(BidsController::class)->group(function () {
        Route::get('bids_list', 'index')->name('bids_list');
        Route::post('edit_bid', 'edit')->name('edit_bid');
        Route::post('filter_bid', 'filter')->name('filter_bid');
    });

    Route::prefix('transaction')->name('transaction.')->controller(TransactionController::class)->group(function () {
        Route::get('withdraw_list', 'withdraw')->name('withdraw_list');
        Route::get('recharge_list', 'recharge')->name('recharge_list');
        Route::get('recharge_list/{id}', 'recharge_edit')->name('recharge_edit');
        Route::post('update_recharge/{id}', 'update_recharge')->name('update_recharge');
        Route::get('create_recharge', 'create_recharge')->name('create_recharge');
        Route::post('create_recharge', 'store_recharge')->name('store_recharge');
        Route::get('edit_withdraw/{id}', 'edit_withdraw')->name('edit_withdraw');
        Route::post('edit_withdraw/{id}', 'update_withdraw')->name('update_withdraw');
    });

    Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
        Route::post('find_user','find')->name('find_user');
        Route::get('index', 'index')->name('index');
        Route::get('my_profile', 'profile')->name('my_profile');

        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        Route::get('destroy/{id}', 'destroy')->name('delete');

        Route::get('user_activities/{id}','activities')->name('activities');
    });
});
