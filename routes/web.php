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
Route::get('asd','FrontEndController@ASD');
Route::get('/', 'FrontEndController@Index');
Route::get('contact', 'FrontEndController@Contact');
Route::post('contact', 'FrontEndController@ContactMail');
Route::get('login', 'UserController@Login');
Route::post('login', 'UserController@LoginPost');
Route::get('signin', 'UserController@Signin');
Route::post('signin', 'UserController@SigninPost');
Route::get('villas/{type}', 'PropertyController@Villas');
Route::get('villa/{v_id}/{title}', 'PropertyController@Villa');
Route::get('services', 'ServiceController@Services');
Route::get('service/{v_id}/{title}', 'ServiceController@Service');
Route::post('service/{v_id}/{title}', 'ServiceController@ServiceMail');
Route::post('subcategory', 'FrontEndController@SubCategory');
Route::get('lost', 'UserController@Lost');
Route::post('lost', 'UserController@LostSend');
Route::get('yonetim', 'YonetimController@Index');
Route::post('yonetim', 'YonetimController@Login');
Route::post('dildegis', 'FrontEndController@DilAyarla');
Route::get('confirmation', 'UserController@OnayLink');
Route::post('confirmation', 'UserController@OnayLinkG');
Route::get('passwordreset/{token}','UserController@PassReset');
Route::post('passwordreset/{token}','UserController@PassResetS');
Route::get('user/confirmation/{userid}/{token}', 'UserController@Onayla');

Route::group(['middleware'  =>  ['auth']], function(){
    Route::group(['prefix' => 'user'], function () {
        Route::get('account', 'UserController@Account');
        Route::post('account', 'UserController@AccountSave');
        Route::get('change_password', 'UserController@Password');
        Route::post('change_password', 'UserController@PasswordPost');
        Route::get('my-properties', 'PropertyController@Index');
        Route::get('property/{p_id?}','PropertyController@Edit');
        Route::post('property/{p_id?}','PropertyController@Save');
        Route::get('property/{p_id}/images','ImageController@Index');
        Route::post('ajax/images','ImageController@Save');
        Route::post('favorite','UserController@FavoriteAdd');
        Route::post('favremove','UserController@FavoriteRemove');
        Route::get('bookmark', 'PropertyController@Bookmark');
        Route::post('propertydelete','PropertyController@Delete');
    });
    Route::get('logout', 'UserController@Logout');
});

Route::group(['middleware'  =>  ['firm']], function(){
    Route::group(['prefix' => 'user'], function () {
        Route::post('ajax/simages','ImageController@SaveS');
        Route::get('my-services', 'ServiceController@Index');
        Route::get('service/{p_id?}','ServiceController@Edit');
        Route::post('service/{p_id?}','ServiceController@Save');
    });
    Route::get('logoutf', 'UserController@LogoutF');
});

Route::group(['middleware' => ['admin']], function(){
    Route::group(['prefix' => 'yonetim'], function () {
        Route::get('ilanlar','YonetimController@Ilanlar');
        Route::get('servisler','YonetimController@Servisler');
        Route::get('kategoriler', 'YonetimController@Kategoriler');
        Route::get('kategori/{p_id?}','YonetimController@KatEdit');
        Route::post('kategori/{p_id?}','YonetimController@KatSave');
        Route::get('ayarlar', 'YonetimController@Ayarlar');
        Route::post('ayarlar', 'YonetimController@AyarlarKaydet');
        Route::post('onayla', 'YonetimController@Onayla');
        Route::get('diller', 'YonetimController@Diller');
        Route::post('diller', 'YonetimController@DillerSave');
        Route::get('dil/{p_id?}', 'YonetimController@Dil');
        Route::post('dil/{p_id?}', 'YonetimController@DilSave');
        Route::get('firmalar', 'YonetimController@Firmalar');
        Route::get('firma/{f_id?}', 'YonetimController@Firma');
        Route::post('firma/{f_id?}', 'YonetimController@FirmaSave');
        Route::get('yorumlar', 'YonetimController@Reviews');
        Route::get('yorum/{f_id?}', 'YonetimController@Review');
        Route::post('yorum/{f_id?}', 'YonetimController@ReviewSave');
        Route::get('yerler', 'YonetimController@Places');
        Route::get('yer/{f_id?}', 'YonetimController@Place');
        Route::post('yer/{f_id?}', 'YonetimController@PlaceSave');
    });
});
Route::get('clear', function() {
    $exitCode = Artisan::call('cache:clear');
});
Route::get('deneme', 'FrontEndController@denemesi');
