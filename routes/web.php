<?php

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

// Xây dựng route project
//Route frontend

use App\Http\Middleware\CheckLogout;
use GuzzleHttp\Middleware;

Route::get('','frontend\IndexController@GetIndex');
Route::get('about','frontend\IndexController@Getabout');
Route::get('contact','frontend\IndexController@GetContact');
Route::get('{slug_cate}.html','frontend\IndexController@GetPrdCate');
Route::get('filter','frontend\IndexController@GetFilter');


// product
Route::group(['prefix' => 'product'], function () {
    Route::get('{slug_prd}.html','frontend\ProductController@GetDetail');
    Route::get('shop','frontend\ProductController@GetShop');
});

//checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('','frontend\CheckOutController@GetCheckout');
    Route::post('','frontend\CheckOutController@PostCheckout');
Route::get('complete/{order_id}','frontend\CheckOutController@GetComplete');
});


//cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('','frontend\CartController@GetCart');
    Route::get('add','frontend\CartController@AddCart');
    Route::get('update/{rowId}/{qty}','frontend\CartController@UpdateCart');
    Route::get('del/{rowId}','frontend\CartController@DelCart');

});




//Backend
Route::get('login','Backend\LoginController@GetLogin')->middleware('CheckLogout');
Route::post('login','Backend\LoginController@PostLogin');

Route::group(['prefix' => 'admin','middleware'=>'CheckLogin'], function () {
    Route::get('','Backend\IndexController@GetIndex');
    Route::get('logout','Backend\IndexController@GetLogout');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('','Backend\CategoryController@GetCategory');
        Route::post('','Backend\CategoryController@PostCategory');
        Route::get('edit/{id_category}','Backend\CategoryController@GetEditCategory');
        Route::post('edit/{id_category}','Backend\CategoryController@PostEditCategory');
        Route::get('del/{id_category}','Backend\CategoryController@DelCategory');


    });

    //user
    Route::group(['prefix' => 'user'], function () {
        Route::get('','Backend\UserController@GetListUser');
        Route::get('add','Backend\UserController@GetAddUser');
        Route::post('add','Backend\UserController@PostAddUser');
        Route::get('edit/{id_user}','Backend\UserController@GetEditUser');
        Route::post('edit/{id_user}','Backend\UserController@PostEditUser');
        Route::get('del/{id_user}','Backend\UserController@DelUser');
    });


    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('','Backend\ProductController@GetListProduct');
        Route::get('add','Backend\ProductController@GetAddProduct');
        Route::post('add','Backend\ProductController@PostAddProduct');
        Route::get('edit/{prd_id}','Backend\ProductController@GetEditProduct');
        Route::post('edit/{prd_id}','Backend\ProductController@PostEditProduct');
        Route::get('del/{prd_id}','Backend\ProductController@DelProduct');

    });

    //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('','Backend\OrderController@GetOrder');
        Route::get('detail/{order_id}','Backend\OrderController@GetDetailOrder');
        Route::get('paid/{order_id}','Backend\OrderController@paid');
        Route::get('processed','Backend\OrderController@GetProcessed');
    });

    
});
