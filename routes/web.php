<?php

//redirecionando  para login

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::check())
    {
        return redirect()->route('home');
    }else{
        return redirect()->route('login');
    }

});

Auth::routes();

Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){

    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login');
    Route::post('logout','LoginController@logout')->name('logout');
});

Route::group(['namespace'=>'Api','middleware'=>['permission','auth'],'prefix'=>'home'],function() {
});

Route::group(['namespace'=>'Api','middleware'=>['permission','auth'],'prefix'=>'home'],function(){
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('user','UserController')->except(['create']);
    Route::get('users','UserController@list')->name('users.list');
    Route::resource('competence','CompetenceController')->except(['create','edit']);
    Route::resource('user_to_construction','UsersToConstructionsController')->except(['create','edit']);
    Route::resource('access_profile','AccessProfileController')->except(['create','edit']);
    Route::resource('address', 'AddressController')->except(['create','edit']);
    Route::resource('city', 'CityController')->except(['create','edit']);
    Route::resource('construction', 'ConstructionController')->except(['create','edit']);
    Route::resource('location', 'LocationController')->except(['create','edit']);
    Route::resource('business', 'BusinessController')->except(['create','edit']);
    Route::resource('regional', 'RegionalController')->except(['create','edit']);
    Route::resource('state', 'StateController')->except(['create','edit']);
    Route::resource('upload_data', 'UploadDataController')->except(['create', 'edit']);
    Route::get('upload_data/approve/{id}','UploadDataController@approve')->name('upload_data.approve');
    Route::get('cities/{id}','ConstructionController@cities')->name('cities');
    Route::get('email/{competence}','EmailController@index')->name('email.index.args');
    Route::get('email/','EmailController@indexWithoutArgs')->name('email.index');
    Route::get('construction/client/{id}','ConstructionController@clientIndex')->name('clientIndex');
    Route::get('construction/client','ConstructionController@clientIndex')->name('clientIndex');
    Route::get('construction/{id}/user','ConstructionController@users')->name('client.construction.list');
    Route::get('construction/{id}/user/add/{user}','ConstructionController@addUser')->name('client.construction.add');
    Route::get('construction/{id}/user/remove/{user}','ConstructionController@removeUser')->name('client.construction.remove');

});


Route::get("download/{file}", function ($file) {
    return response()->download(url("storage/".$file));
})->name('download');

Route::group(['namespace' => 'Api', 'prefix' => 'area-do-cliente'], function (){
    Route::get('/recuperar-senha', function(){
        return view('area-do-cliente.esqueceu_a_senha');
    })->name('client-space.recover-password');
    Route::get('/alterar-senha/{id}', function(){
        return view('area-do-cliente.nova_senha');
    })->name('client-space.change-password');
});

Route::group(['namespace'=>'Api','middleware'=>'auth', 'prefix'=>'area-do-cliente'], function (){
    Route::get('/detalhes/{id}/{competence}', 'ClientSpaceController@detail')->name('client-space.construction-detail');
    Route::get('/fotos/{id}', 'ClientSpaceController@downloadPictures')->name('client-space.pictures-download');
    Route::get('/relatorio', 'ClientSpaceController@report')->name('client-space.construction-report');
    Route::get('/relatorio/{id}', 'ClientSpaceController@downloadReports')->name('client-space.report-download');
    Route::get('/docs-obra/{competence}/{id}', 'ClientSpaceController@documents')->name('client-space.construction-documents');
    Route::get('/logout', function (){
        Auth::logout();
        return redirect()->route('login');
    })->name('client-space.logout');
    Route::get('competences/{construction}/{year}/{month}','ClientSpaceController@documentsByMonthYear')->name('competence.list');
    Route::get('competences/{construction}/{yearmonth}','ClientSpaceController@documentsByYearOrMonth')->name('competence.list.args');
    Route::get('/', 'ClientSpaceController@index')->name('client-space.index');
});
