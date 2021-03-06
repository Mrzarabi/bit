<?php

use App\Mail\CloseTicketMail;
use App\Models\Ticket\Ticket;

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

Auth::routes();

// Admin panel Routes
Route::group(['middleware' => ['web', 'role:owner'], 'prefix' => 'panel', 'namespace' => 'panel'], function () {
    // Dashboard Route
    Route::get('/{total_type?}', 'PanelController@index')
        ->where('total_type', 'daily|weekly|monthly|yearly');

    // Invoices Routes
    // Route::group(['prefix' => 'invoice'], function () {

    //     Route::get('/', 'InvoiceController@index');
    //     Route::get('/{order}', 'InvoiceController@get');
    //     Route::get('/{order}/description/{description}', 'InvoiceController@description');
    //     Route::get('/{order}/status/{status}', 'InvoiceController@status');
    // });

    // Discount code Routes
    // Route::resource('discountCode', 'DiscountCodeController')->except([ 'create', 'show' ]);    

    // Setting Route
    Route::group(['prefix' => 'setting'], function () {

        Route::get('/', 'PanelController@setting');
        Route::post('/slider', 'PanelController@slider');
        Route::post('/posters', 'PanelController@poster');
        Route::post('/info', 'PanelController@info');
        Route::post('/social_link', 'PanelController@social_link');
        Route::post('/shipping_cost', 'PanelController@shipping_cost');
        Route::get('/dollar_cost/{dollar_cost}', 'PanelController@dollar_cost');
    });

    // Users panel Route
    Route::resource('user', 'UserController')->except(['create', 'store']);
    Route::put('user/{user}/accept', 'UserController@accept_certificate')->name('accept_certificate');
    Route::put('user/{bank_card}/acceptbank', 'UserController@accept_certificate_bank')->name('accept_certificate_bank');
    Route::get('user/{user}/editPass', 'UserController@editPass')->name('editPass');
    Route::get('user/{user}/show_purchases', 'UserController@show_purchases')->name('show_purchases');
    Route::put('user/{user}/updatePass', 'UserController@updatePass')->name('updatePass');
    Route::put('user/{user}/canbuy', 'UserController@canBuy')->name('canBuy');

    Route::resource('role', 'RoleController')->except(['show']);
    Route::put('role/{$role}/updatePermissions', 'RoleController@updatePermissions')->name('updatePermissions');

    // Tickets & TicketMessages panel Route
    Route::resource('ticket', 'TicketController')->except(['create', 'show', 'update']);
    Route::put('ticket/{ticket}/is_close', 'TicketController@is_close')->name('ticket.is_close');

    Route::resource('ticket_message', 'TicketMessageController');

    // Category Route
    Route::resource('category', 'CategoryController')->except(['create']);
    Route::get('group/sub/{id}', 'CategoryController@sub');

    // Currencies panel Route
    Route::resource('currency', 'CurrencyController')->except(['show']);

    // Specification tables handler panel Route
    Route::resource('specification', 'Spec\SpecificationController')->except(['create', 'show']);
    Route::group(['prefix' => 'specification/{specification}'], function () {
        Route::resource('header', 'Spec\SpecHeaderController')->except(['create', 'show']);
    });
    Route::group(['prefix' => 'specification/header/{header}'], function () {
        Route::resource('row', 'Spec\SpecRowController')->except(['create', 'show']);
    });

    // Subject Route
    Route::resource('subject', 'SubjectController')->except(['create', 'show']);

    // Articles panel Route
    Route::resource('article', 'ArticleController');

    // Comments panel Route
    // Route::resource('comment', 'CommentController')->except([ 'index', 'create', 'show', 'edit', 'update' ]);
    // Route::put('comment/{comment}/is_accept', 'CommentController@is_accept')->name('is_accept');
    // Route::put('comment/{comment}/replie_comment/{reply?}', 'CommentController@replie_comment')->name('replie_comment');

    // Color panel routes
    // Route::resource('color', 'ColorController')->except([ 'create', 'show' ]);
    // Warranty panel routes
    // Route::resource('warranty', 'WarrantyController')->except([ 'create', 'show' ]);
    // Brand panel routes
    // Route::resource('brand', 'BrandController')->except([ 'create', 'show' ]);
});


Route::group(['middleware' => ['web'], 'prefix' => 'panel', 'namespace' => 'Client'], function () {

    Route::resource('client', 'ShowClient');
    Route::get('profile-setting/{user}', 'ShowClient@profile_setting')->name('profile_setting');
    Route::post('client/store/', 'ShowClient@storeTicket')->name('storeTicket');
    Route::post('client/store/bankCard', 'ShowClient@storeBankCard')->name('storeBankCard');
    Route::get('editTicket/{ticket}', 'ShowClient@editTicket')->name('editTicket');
    Route::post('client/storeTicketMessage/', 'ShowClient@storeTicketMessage')->name('storeTicketMessage');
    Route::put('client/update/imageBankCard/{bank_card}', 'ShowClient@updateImageBankCard')->name('updateImageBankCard');
    Route::put('prfile/update/{user}', 'ShowClient@updateProfile')->name('updateProfile');
    Route::put('prfile/update/{user}/image', 'ShowClient@updateImageProfile')->name('updateImageProfile');
});

// Store Products Routes
Route::get('/', 'StoreController@index')->name('index');
Route::get('/about', 'StoreController@about');
Route::get('/currency', 'StoreController@store');
Route::get('/currency/search/{query?}', 'StoreController@store');
Route::post('/currency/{currency}/review', 'StoreController@add_review')->middleware('auth');
Route::get('/category/{category}', 'StoreController@category');
Route::get('/currency/{currency}', 'StoreController@product');

// Cart Rotes
Route::get('/cart', 'CartController@index');
Route::post('/cart/pay', 'CartController@pay')->middleware('auth');
Route::get('/cart/discount_code/{discount_code}', 'CartController@discount_code')->middleware('auth');
Route::delete('/cart/remove/{variation}', 'CartController@remove');
Route::get('/cart/add/{variation}', 'CartController@add');

Route::get('/orders', 'panel\InvoiceController@user_orders')->middleware('auth');
Route::get('/orders/{order}', 'panel\InvoiceController@order_detail')->middleware('auth');
Route::get('/verify_payment', 'CartController@verify_payment');
Route::get('/checkout', 'CartController@checkout')->middleware('auth');
Route::post('/checkout', 'CartController@checkout')->middleware('auth');

// Compare Routes
// Route::get('/compare', 'CompareController@index');
// Route::get('/compare/add/{product}', 'CompareController@add');
// Route::get('/compare/remove/{product}', 'CompareController@remove');

// Blog Routes
Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog/{article}', 'BlogController@show')->name('article.blog');
Route::get('/subject/{subject}', 'BlogController@showSubject')->name('show.subject');
Route::get('blog/tagged/{tag}', 'BlogController@tagged')->name('tagged');

// Route::get('/send/email', 'HomeController@mail');
Route::get('/home', 'HomeController@index')->name('home');
