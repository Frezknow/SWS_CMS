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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** CMS routes **/
Route::group(['prefix'=>'cms','middleware'=>'auth'],function(){
  Route::get('welcome','cmsController@index');
  Route::put('updateLayouts','cmsController@updateLayouts');
  Route::get('about','cmsController@about');
  Route::get('user','cmsController@user');
  Route::get('contact','cmsController@contact');

  Route::get('/GetBackgroundImages','cmsController@GetBackgroundImages');
  Route::put('/updateFormVerbage/{id}','ContactController@updateFormVerbage');
  Route::delete('/deleteSlider/{id}','AboutController@deleteSlider');
  Route::post('/editBG_Color','WelcomeController@editBG_Color');
  Route::post('/editBG_Color_About','AboutController@editBG_Color');
  Route::post('/editBG_Color_Contact','ContactController@editBG_Color');
  Route::post('/Welcomes/UpdateBGImage','WelcomeController@UpdateBGImage');
  Route::resource('/Welcomes','WelcomeController',[
    'except' => ['edit','show']
  ]);

  Route::post('/Abouts/addSlide','AboutController@addSlide');
  Route::post('/Abouts/UpdateBGImage','AboutController@UpdateBGImage');
  Route::get('/Abouts/Slider','AboutController@Slider');

  Route::resource('/Abouts','AboutController',[
    'except' => ['edit','show']
  ]);
  Route::post('/Contacts/Email','ContactController@email');
  Route::post('/Contacts/UpdateBGImage','ContactController@UpdateBGImage');
  Route::resource('/Contacts','ContactController',[
    'except' => ['edit','show']
  ]);
});
