<?php

#use Illuminate\Support\Facades\Route;

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

//闭包路由
// Route::get('/', function () {
// 	//echo "hello";
//     return view('welcome');
// });
Route::get('hello', function () {
	echo "hello! welcome to 1911";
});
//走控制器方法的路由
Route::get('index', 'TestController@index');

//post提交方式

//三种显示模板视图的写法
//Route::get('add', 'TestController@add');

// Route::get('add', function () {
// 	//echo "hello";
//     return view('add');
// });
//路由视图
//Route::view('add', 'add');
Route::post('adddo', 'TestController@adddo');

//注册一个路由支持多种请求方式
//Route::any('add', 'TestController@add');
Route::match(['get','post'],'add', 'TestController@add');

//必选参数
Route::get('user/{id}', function ($id) { 
	return 'User ' . $id;
})->where('id','\d+');

// Route::get('goods/{id}', function ($id) { 
// 	return 'goods ' . $id;
// });
//Route::get('goods/{id}', 'TestController@goods');

Route::get('goods/{id}/{name}', 'TestController@goods')->where(['id'=>'\d+','name'=>'[a-zA-Z]+']);

//可选参数
Route::get('show/{id?}', 'TestController@show');
Route::get('detail/{id}/{name?}', 'TestController@detail');

Route::domain('admin.1911.com')->group(function () {
	Route::get('/', 'Admin\GoodsController@index')->middleware('login');
	//商品品牌模块
	Route::prefix('brand')->middleware('login')->group(function () {
		Route::get('/', 'Admin\BrandController@index');
		Route::get('create', 'Admin\BrandController@create');
		Route::post('store', 'Admin\BrandController@store');
		Route::get('edit/{id}', 'Admin\BrandController@edit');
		Route::post('update/{id}', 'Admin\BrandController@update');
		Route::get('destroy/{id}', 'Admin\BrandController@destroy');
	});
	//商品分类
	Route::prefix('cate')->middleware('login')->group(function () {
		Route::get('/', 'Admin\CateController@index');
		Route::get('create', 'Admin\CateController@create');
		Route::post('store', 'Admin\CateController@store');
		Route::get('edit/{id}', 'Admin\CateController@edit');
		Route::post('update/{id}', 'Admin\CateController@update');
		Route::get('destroy/{id}', 'Admin\CateController@destroy');
	});
	//商品管理
	Route::prefix('goods')->middleware('login')->group(function () {
		Route::get('/', 'Admin\GoodsController@index');
		Route::get('create', 'Admin\GoodsController@create');
		Route::post('store', 'Admin\GoodsController@store');
		Route::get('edit/{id}', 'Admin\GoodsController@edit');
		Route::post('update/{id}', 'Admin\GoodsController@update');
		Route::get('destroy/{id}', 'Admin\GoodsController@destroy');
		Route::post('checkName', 'Admin\GoodsController@checkName');
	});

	Route::get('/login', 'Admin\LoginController@index');
	Route::post('/logindo', 'Admin\LoginController@logindo');
	Route::get('/logout', 'Admin\LoginController@logout');

	//cookie练习
	Route::get('/setcookie', 'Admin\LoginController@setcookie');
	Route::get('/getcookie', 'Admin\LoginController@getcookie');
});

//微商城前台首页
Route::domain('www.1911.com')->group(function () {
	Route::get('/', 'Index\IndexController@index')->name('shop.index');
	Route::get('/login', 'Index\LoginController@login');
	Route::post('/logindo', 'Index\LoginController@logindo');
	Route::get('/reg', 'Index\LoginController@reg');
	Route::post('/regdo', 'Index\LoginController@regdo');
	Route::get('/sendSms', 'Index\LoginController@sendSms');
	Route::get('/sendEmail', 'Index\LoginController@sendEmail');
	Route::get('/goods/{goods_id}', 'Index\GoodsController@index')->name('shop.goods');
	Route::get('/addcar', 'Index\GoodsController@addcar');
	Route::get('/cart', 'Index\CartController@index')->middleware('checkmember')->name('shop.cart');
	Route::get('/getprice', 'Index\GoodsController@getprice');

	Route::get('/news', 'Index\NewsController@index');
	Route::get('/news/test/{id}', 'Index\NewsController@test');

});

