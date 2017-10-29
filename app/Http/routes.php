<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 * Admin login routes
 */
Route::get('admincp/login', [
  'as' => 'AdminLoginGet',
  'middleware' => 'guest',
  'uses' => 'Admin\MainController@getLogin'
]);
Route::post('admincp/login', [
  'as' => 'AdminLoginPost',
  'middleware' => 'guest',
  'uses' => 'Admin\MainController@postLogin'
]);
Route::get('admincp/logout', [
  'as' => 'AdminLogout',
  'middleware' => ['auth', 'admincp'],
  'uses' => 'Admin\MainController@logout'
]);
Route::group(['prefix' => 'admincp', 'middleware' => 'admincp'], function () {
    Route::get('/', [
      'as' => 'AdminOverview',
      'uses' => 'Admin\MainController@index'
    ]);
    /**
     * Category related routes
     */
    Route::get('/categories', [
      'as' => 'AdminCategoryIndex',
      'uses' => 'Admin\CategoryController@index'
    ]);
    Route::get('/categories/create', [
      'as' => 'AdminCategoryCreate',
      'uses' => 'Admin\CategoryController@create'
    ]);
    Route::post('/categories', [
      'as' => 'AdminCategoryStore',
      'uses' => 'Admin\CategoryController@store'
    ]);
    Route::get('/categories/{category}', [
      'as' => 'AdminCategoryShow',
      'uses' => 'Admin\CategoryController@show'
    ]);
    Route::get('/categories/{category}/edit', [
      'as' => 'AdminCategoryEdit',
      'uses' => 'Admin\CategoryController@edit'
    ]);
    Route::patch('/categories/{category}', [
      'as' => 'AdminCategoryUpdate',
      'uses' => 'Admin\CategoryController@update'
    ]);
    Route::get('/categories/{category}/delete', [
      'as' => 'AdminCategoryDelete',
      'uses' => 'Admin\CategoryController@delete'
    ]);
    Route::delete('/categories/{category}', [
      'as' => 'AdminCategoryDestroy',
      'uses' => 'Admin\CategoryController@destroy'
    ]);
    /**
     * Game related routes
     */
    Route::get('/games', [
      'as' => 'AdminGameIndex',
      'uses' => 'Admin\GameController@index'
    ]);
    Route::get('/games/search', [
      'as' => 'AdminGameSearch',
      'uses' => 'Admin\GameController@search'
    ]);
    Route::get('/games/create', [
      'as' => 'AdminGameCreate',
      'uses' => 'Admin\GameController@create'
    ]);
    Route::post('/games', [
      'as' => 'AdminGameStore',
      'uses' => 'Admin\GameController@store'
    ]);
    Route::get('/games/{game}', [
      'as' => 'AdminGameShow',
      'uses' => 'Admin\GameController@show'
    ]);
    Route::get('/games/{game}/edit', [
      'as' => 'AdminGameEdit',
      'uses' => 'Admin\GameController@edit'
    ]);
    Route::patch('/games/{game}', [
      'as' => 'AdminGameUpdate',
      'uses' => 'Admin\GameController@update'
    ]);
    Route::get('/games/{game}/delete', [
      'as' => 'AdminGameDelete',
      'uses' => 'Admin\GameController@delete'
    ]);
    Route::delete('/games/{game}', [
      'as' => 'AdminGameDestroy',
      'uses' => 'Admin\GameController@destroy'
    ]);
    /**
     * Order related routes
     */
    Route::get('/orders', [
      'as' => 'AdminOrderIndex',
      'uses' => 'Admin\OrderController@index'
    ]);
    Route::get('/orders/filter', [
      'as' => 'AdminOrderFilter',
      'uses' => 'Admin\OrderController@filter'
    ]);
    Route::get('/orders/{order}', [
      'as' => 'AdminOrderShow',
      'uses' => 'Admin\OrderController@show'
    ]);
    Route::get('/orders/{order}/edit', [
      'as' => 'AdminOrderEdit',
      'uses' => 'Admin\OrderController@edit'
    ]);
    Route::patch('/orders/{order}', [
      'as' => 'AdminOrderUpdate',
      'uses' => 'Admin\OrderController@update'
    ]);
    /**
     * Customer related admincp routes
     */
    Route::model('user', 'App\User');
    Route::get('/customers', [
      'as' => 'AdminCustomerIndex',
      'uses' => 'Admin\CustomerController@index'
    ]);
    Route::get('/customers/{user}', [
      'as' => 'AdminCustomerShow',
      'uses' => 'Admin\CustomerController@show'
    ]);
});
/**
 * Registration, logging in and activation routes
 */
Route::get('/register', [
  'middleware' => 'guest',
  'as' => 'StoreUserRegisterGet',
  'uses' => 'UserController@getRegister'
]);
Route::post('/register', [
  'middleware' => 'guest',
  'as' => 'StoreUserRegisterPost',
  'uses' => 'UserController@postRegister'
]);
Route::get('/login', [
  'middleware' => 'guest',
  'as' => 'StoreUserLoginGet',
  'uses' => 'UserController@getLogin'
]);
Route::post('/login', [
  'middleware' => 'guest',
  'as' => 'StoreUserLoginPost',
  'uses' => 'UserController@postLogin'
]);
Route::get('/logout', [
  'middleware' => 'auth',
  'as' => 'StoreUserLogout',
  'uses' => 'UserController@logout'
]);
Route::get('user/activate/{code}', [
  'middleware' => 'guest',
  'as' => 'UserActivationGet',
  'uses' => 'UserController@getActivation'
]);
Route::get('/', 'StoreController@index');
/**
 * Cart routes
 */
Route::post('/cart/add-to-cart', [
  'as' => 'StoreAddToCart',
  'uses' => 'Store\CartController@add'
]);
Route::get('/cart', [
  'as' => 'StoreCart',
  'uses' => 'Store\CartController@show'
]);
Route::post('/cart/remove-from-cart', [
  'as' => 'StoreRemoveFromCart',
  'uses' => 'Store\CartController@remove'
]);
Route::get('/cart/clear-cart', [
  'as' => 'StoreClearCart',
  'uses' => 'Store\CartController@clear'
]);
/**
 * Checkout and order routes
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart/checkout', [
      'as' => 'StoreCartCheckout',
      'middleware' => 'checkout',
      'uses' => 'Store\CartController@checkout'
    ]);
    Route::get('/cart/order', [
      'as' => 'StoreOrder',
      'middleware' => 'checkout',
      'uses' => 'Store\OrderController@show'
    ]);
    Route::post('/cart/order', [
      'as' => 'StoreOrderShipping',
      'middleware' => 'checkout',
      'uses' => 'Store\OrderController@proccessShipping'
    ]);
    Route::get('/cart/order/confirm', [
      'as' => 'StoreOrderConfirm',
      'middleware' => 'checkout',
      'uses' => 'Store\OrderController@confirm'
    ]);
    Route::post('/cart/order/pay', [
      'as' => 'StoreOrderPay',
      'middleware' => 'checkout',
      'uses' => 'Store\OrderController@pay'
    ]);
});
Route::get('/contact', [
  'as' => 'StoreContact',
  'uses' => 'StoreController@contact'
]);
/**
 * User profile related routes
 */
Route::get('/profile', [
  'as' => 'StoreUserProfile',
  'middleware' => 'auth',
  'uses' => 'UserController@userProfile'
]);
Route::get('/profile/order/{order}', [
  'as' => 'StoreUserOrderShow',
  'middleware' => 'auth',
  'uses' => 'UserController@showUserOrder'
]);
/**
 * Showing games and categories
 * IMPORTANT: Always have this routes on last lines
 */
Route::get('/search', [
  'as' => 'StoreGameSearch',
  'uses' => 'StoreController@searchGame'
]);
Route::get('/games/{game}', [
  'middleware' => 'store.game',
  'as' => 'StoreGameShow',
  'uses' => 'StoreController@showGame'
]);
Route::get('/{category}', [
  'middleware' => 'store.category',
  'as' => 'StoreCategoryShow',
  'uses' => 'StoreController@showCategory'
]);