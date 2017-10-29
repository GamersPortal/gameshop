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
     * Product related routes
     */
    Route::get('/products', [
      'as' => 'AdminProductIndex',
      'uses' => 'Admin\ProductController@index'
    ]);
    Route::get('/products/search', [
      'as' => 'AdminProductSearch',
      'uses' => 'Admin\ProductController@search'
    ]);
    Route::get('/products/create', [
      'as' => 'AdminProductCreate',
      'uses' => 'Admin\ProductController@create'
    ]);
    Route::post('/products', [
      'as' => 'AdminProductStore',
      'uses' => 'Admin\ProductController@store'
    ]);
    Route::get('/products/{product}', [
      'as' => 'AdminProductShow',
      'uses' => 'Admin\ProductController@show'
    ]);
    Route::get('/products/{product}/edit', [
      'as' => 'AdminProductEdit',
      'uses' => 'Admin\ProductController@edit'
    ]);
    Route::patch('/products/{product}', [
      'as' => 'AdminProductUpdate',
      'uses' => 'Admin\ProductController@update'
    ]);
    Route::get('/products/{product}/delete', [
      'as' => 'AdminProductDelete',
      'uses' => 'Admin\ProductController@delete'
    ]);
    Route::delete('/products/{product}', [
      'as' => 'AdminProductDestroy',
      'uses' => 'Admin\ProductController@destroy'
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
 * Showing products and categories
 * IMPORTANT: Always have this routes on last lines
 */
Route::get('/search', [
  'as' => 'StoreProductSearch',
  'uses' => 'StoreController@searchProduct'
]);
Route::get('/products/{product}', [
  'middleware' => 'store.product',
  'as' => 'StoreProductShow',
  'uses' => 'StoreController@showProduct'
]);
Route::get('/{category}', [
  'middleware' => 'store.category',
  'as' => 'StoreCategoryShow',
  'uses' => 'StoreController@showCategory'
]);