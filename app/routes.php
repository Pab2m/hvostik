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
Route::get('/',array('as'=>'home','uses'=> 'HomeController@index'));
Route::get('/registration',  function(){return View::make('registration');});
Route::get('/vhod',  function(){return View::make('vhod');});
Route::get('/logout',  function(){Auth::logout(); return Redirect::to('/');});
Route::post('/login', 'UserController@login');

Route::get('/fyurer',  'AdminController@adminPanel');
Route::get('/fyurer/post/edit/{id}',  'AdminController@adminEditId');
Route::get('/fyurer/posts/{id}',  'AdminController@adminPosts');
Route::get('/fyurer/announcement_admin_goot/{id}', array('as'=>'announcement_admin_goot','uses'=>'AdminController@announcement_admin_goot'));
Route::get('/fyurer/post/{id}',  'AdminController@adminPostID');
Route::get('/fyurer/post/windopen/{id}',  'AdminController@adminPostIdWinOpen');
Route::get('/fyurer/users/',  'AdminController@adminUsers');
Route::get('/fyurer/staticpages', array('as'=>'staticpages','uses'=>'AdminController@adminStaticPages'));
Route::get('/fyurer/staticpage/add',  'AdminController@adminStaticpageAddViews');
Route::post('/fyurer/staticpage/add',  'AdminController@adminStaticpageAdd');
Route::get('/fyurer/staticpage/{id}',  array('as'=>'staticpageId','uses'=>'AdminController@adminStaticpage'));
Route::get('/fyurer/staticpage/edit/{id}',  'AdminController@adminStaticpageEdit');
Route::post('/fyurer/staticpage/edit',  'AdminController@adminStaticpageEditForm');
Route::get('/fyurer/select',  'AdminController@adminSelect');
Route::get('/fyurer/select/site/{region}',  'AdminController@adminSelectSity');
Route::get('/fyurer/select/detail/{url}',  'AdminController@adminSelectDetailAll');
Route::get('/fyurer/select/jsonrecord/{url}',  'AdminController@jsonGetFail');
Route::post('/fyurer/select/detail',  'AdminController@selectDetailEdit');
Route::post('/fyurer/select/detail/add',  'AdminController@selectDetailAdd');
Route::post('/fyurer/select/detail/addnotdubal',  'AdminController@selectDetailAddNotDubol');
Route::post('/fyurer/select/delete',  'AdminController@selectDelete');
Route::post('/fyurer/select/delete/site/table','AdminController@adminSelectSity');
Route::post('/fyurer/select/site/edit',  'AdminController@adminSelectSityEdit');

Route::post('/registration','UserController@register');
Route::get('/registration/{id}/{activation_code}','UserController@getActivate');

Route::get('/user/auth/vk','UserController@authVk');
Route::get('/user/auth/vk/{code}','UserController@authVk_token',array('as'=>'Vk_token'));



Route::controller('password', 'RemindersController');

Route::get('/add_announcement','PostController@add');
Route::post('/add_announcement',array('before'=>'csrf', 'uses'=>'PostController@postAdd')); 
Route::post('/add_img','PostController@addImg');

Route::get('/announcement_goot/{title}', array('as'=>'announcement_goot','uses'=>'PostController@AddTrue'));
Route::get('/private_office', array('as'=>'private_office','uses'=>'PostController@PostsUser'));
Route::post('/private_office', array('as'=>'DeletPosts','uses'=>'PostController@DeletPosts'));
Route::get('/post/edit/{id}',array('as'=>'EditPostMake','uses'=>'PostController@EditPostMake'));
Route::post('/post/edit/',array('as'=>'EditPostMake','uses'=>'PostController@EditPost','before'=>'csrf'));
Route::post('/post/delet/{id}',array('as'=>'EditPostDelet','uses'=>'PostController@DeletPosts','before'=>'csrf'));
Route::get('/post/{id}',array('as=>PostId','uses'=>'PostController@PostId'));
Route::get('/page/{url}',  'PostController@StaticPage');

Route::get('/search','SearchController@search');
Route::get('/search/data/{ajax}','SearchController@searchData');
//Тест 
Route::get('/test/',function(){
return View::make('password.reset');
});
Route::get('/test/form/' ,function(){ return View::make('form');});

//----------------------------------------

Route::get('/ajax/sity/{id}','AjaxController@getSity');
Route::get('/ajax/sity/array/{id}','AjaxController@SityArray');
Route::get('/ajax/type/{url_ajax}','AjaxController@valueType');
Route::get('/ajax/tip/','AjaxController@getTip');
Route::get('/ajax/tip_search/{name_tabel}','AjaxController@getTipSearch');
Route::get('/ajax/sity_search/{id}','AjaxController@getSitySearch');
Route::get('/ajax/id_region_sity/{id}','AjaxController@idRegionSity_Region');
Route::get('/ajax/region/{id}/{pole?}','AjaxController@idRegion');
Route::post('/ajax/user/message','AjaxController@UserMessage');
Route::post('/ajax/admin/postsost','AjaxController@AdminPostSost');
Route::get('/ajax/admin/schetpost','AjaxController@AdminPostCount');
Route::post('/ajax/admin/datepost','AjaxController@AdminPostEditDate');
Route::get('/ajax/admin/postsost/control','AdminController@adminControlPost');
Route::post('/ajax/admin/apdeitpost','AdminController@adminControlAbdeitPostSost');
Route::post('/ajax/admin/json/update','AdminController@JsonUpdate');
Route::get('/ajax/json/update','AdminController@JsonUpdate');
Route::get('/ajax/json/bd/{bd}','AjaxController@TableBdJsonTab');


Route::get('/bd', "AdminController@adminSelectSity2");