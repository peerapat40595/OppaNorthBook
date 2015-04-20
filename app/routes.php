<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Confide routes


Route::post('user',                        'UserController@store');

Route::post('user/login',                  'UserController@do_login');

Route::post('user/forgot_password',        'UserController@do_forgot_password');

Route::post('user/reset_password',         'UserController@do_reset_password');

Route::get('karn',function(){
      return 
'<html>
<body>
<a href="itms-services://?action=download-manifest&url=https://dl-web.dropbox.com/get/iPhone/Fruit%20Karn.plist">Fruit karn</a>
</body>
</html>';
});

Route::get('about', function(){
	return View::make('about');
});

Route::controller('secrettips','ShowPostController');

///cos is coming to town
/////////////////TEST COOKIE//////////////////////////
Route::get('testCookie',function(){

	$show_sp_code = Cookie::get('sp_code');


	return 'sp_code = '.$show_sp_code.' ..';
});
////////////////////////////////////////////////////////



///all route that have to set cookie
Route::group(array('before' => 'setcookie'),function()
{

	Route::get('/', function()
	{
		$post = Post::orderBy('created_at','desc')->get()->first();

		if(!is_null($post)){
			$date = $post->created_at;
			$date = $date->formatlocalized('%A %d %B %Y');
		} else $date = null;
		
		return View::make('pages.home')
		->with('post', $post)
		->with('date', $date);
		
	});
	

	Route::get( 'user/login','UserController@login');
	Route::get( 'user/create',                 'UserController@create');
	Route::get( 'user/confirm/{code}',         'UserController@confirm');
	Route::get( 'user/forgot_password',        'UserController@forgot_password');
	Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
	Route::get( 'user/logout',                 'UserController@logout');

	//shop
	Route::get( 'shop' , 'ShopController@shop');
	Route::get( 'shop/attributejson' , 'ShopController@attributes');
	Route::post( 'shop' , 'ShopController@addtocart');

	Route::filter('auth',function(){
		if(!Auth::check()) return Redirect::to('user/login');
	});

	Route::group(array('before' => 'auth'), function(){

		Route::get('shop/cart', 'ShopController@cart');
		Route::post('shop/deleteorder/{id}', 'ShopController@deleteorder');
		Route::post('shop/cart/confirm/{id}', 'ShopController@tos1');
	});


});

///end cos is coming to town.



Route::controller('productrest', 'ProductRestController');

Route::controller('userrest', 'UserRestController');

Route::get('image/{src}/{w?}/{h?}',function($src,$w=200,$h=200){
	//intervention image cache

	//closure and coping anoymous function
	$cacheimage = Image::cache(function($image) use ($src,$w,$h){
		return $image->make('img/products/'.$src)->resize($w,$h);			
	},10,true);
	return Response::make($cacheimage,200,array('Content-Type'=>'image/jpeg'));
});




Route::filter('auth_admin',function(){
	if(Auth::check()){
		if(!Confide::user()->isadmin) return "You don't have permission";
	} else return Redirect::to('user/login');

});


Route::group(array('before' => 'auth_admin'), function(){


	Route::controller('checkorder','CheckOrderController');

	Route::resource('product', 'ProductController');
	Route::resource('book', 'BookController');
	Route::resource('brand', 'BrandController');
	Route::resource('category', 'CategoryController');
	Route::resource('manage_user', 'UserEditController'); //on edit

	Route::get( 'product/toggleorderconfirmed/{id}' ,function ($id)
	{
		$orderconfirmation = Confirmation::find($id);
		$product->availability = !$product->availability;
		$product->save();
		return $product;
	});
	Route::get( 'product/toggle/{id}' ,function ($id)
	{
		$product = Prod::find($id);
		$product->availability = !$product->availability;
		$product->save();
		return $product;
	});
	Route::get( 'user/toggleissp/{id}' ,function ($id)
	{
		$user = User::find($id);
		$user->issp = !$user->issp;
		$user->updateUniques();
		return $user;
	});
	Route::get( 'user/togglebanned/{id}' ,function ($id)
	{
		$user = User::find($id);
		$user->banned = !$user->banned;
		$user->updateUniques();
		return $user;
	});
	Route::get( 'user/toggleconfirmed/{id}' ,function ($id)
	{
		$user = User::find($id);
		$user->confirmed = !$user->confirmed;
		$user->updateUniques();
		return $user;
	});
	Route::get( 'user/toggleisadmin/{id}' ,function ($id)
	{
		$user = User::find($id);
		$user->isadmin = !$user->isadmin;
		$user->updateUniques();
		return $user;
	});


});



Route::filter('auth_sp',function(){
	if(Auth::check()){
		if(!Confide::user()->issp) return "You don't have permission";
	} else return Redirect::to('user/login');

});

Route::group(array('before' => 'auth_sp'), function(){
	Route::controller('spcheckorder','SpCheckOrderController');
});

//blog post
Route::resource('posts', 'PostController');


Route::group(array('before' => 'auth_sp'), function(){
});


/////////
Route::controller('doorder','DoOrderController');
