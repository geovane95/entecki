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


Route::group(['prefix'=>'auth','namespace'=>'Auth','middlewares'=>['web','guest']],function(){

    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login');
    Route::post('logout','LoginController@logout')->name('logout');
});


Route::group(['namespace'=>'Api','middleware'=>['permission','auth'],'prefix'=>'home'],function(){


    Route::get('', 'HomeController@index')->name('home');
    Route::resource('user','UserController')->except(['create']);
    Route::resource('competence','CompetenceController')->except(['create','edit']);
    Route::resource('user_to_construction','UsersToConstructionsController')->except(['create','edit']);
    Route::resource('access_profile','AccessProfileController')->except(['create','edit']);
    Route::resource('address', 'AddressController')->except(['create','edit']);
    Route::resource('city', 'CityController')->except(['create','edit']);
    Route::resource('construction', 'ConstructionController')->except(['create','edit']);
    Route::resource('location', 'LocationController')->except(['create','edit']);
    Route::resource('responsible', 'ResponsibleController')->except(['create','edit']);
    Route::resource('state', 'StateController')->except(['create','edit']);
    Route::resource('upload_data', 'UploadDataController')->except(['create','edit']);
    Route::get('cities/{id}','ConstructionController@cities')->name('citites');
    //Route::get('email/{competence}/{construction}','EmailController@store')->name('email.store');
    Route::get('email/','EmailController@index')->name('email.index');
    Route::get('construction/client/{id}','ConstructionController@clientIndex')->name('clientIndex');
    Route::get('construction/client','ConstructionController@clientIndex')->name('clientIndex');

    // Route::get('construction/client','ConstructionController@clientIndex')->name('clientIndex');
    Route::get('state/{id}','StateController@stateCity')->name('city.state');
    Route::get('construction/{id}/client','ConstructionController@clients')->name('client.construction.list');
    Route::get('construction/{id}/client/add/{client}','ConstructionController@addClient')->name('client.construction.add');
    Route::get('construction/{id}/client/remove','ConstructionController@removeClient')->name('client.construction.remove');

});


Route::get("download/{file}", function ($file) {
    return response()->download(storage_path("app/public/".$file));
})->name('download');


Route::group(['namespace'=>'Api','middleware'=>'auth', 'prefix'=>'area-do-cliente'], function (){
    Route::get('/', 'ClientSpaceController@indexWithNoParams')->name('client-space.index');
    Route::get('/{competence}/{construction}', 'ClientSpaceController@index')->name('client-space.index.args');
    Route::get('/recuperar-senha', function(){
        return view('area-do-cliente.esqueceu_a_senha');
    })->name('client-space.recover-password');
    Route::get('/alterar-senha/{id}', function(){
        return view('area-do-cliente.nova_senha');
    })->name('client-space.change-password');
    //Route::get('/detalhe/{id}', 'ClientSpaceController@detail')->name('client-space.construction-detail');
    Route::get('/docs-obra/{competence}/{id}', 'ClientSpaceController@documents')->name('client-space.construction-documents');
    Route::get('/relatorio', 'ClientSpaceController@report')->name('client-space.construction-report');
    Route::get('/logout', function (){
        Auth::logout();
        return redirect()->route('login');
    })->name('client-space.logout');
    Route::get('/pictures-download/{competence}/{id}', function (){
        return view('area-do-cliente.relatorio');
    })->name('client-space.pictures-download');
    Route::get('competences/{construction}/{year}/{month}','ClientSpaceController@documentsByMonthYear')->name('competence.list');
    Route::get('competences/{construction}/{year}','ClientSpaceController@documentsByYear')->name('competence.list.year');
    Route::get('competences/{construction}/{month}','ClientSpaceController@documentsByMonth')->name('competence.list.month');
});


Route::get('/area-do-cliente/detalhe/{id}', 'Api\ClientSpaceController@detail')->middleware('auth')->name('client-space.construction-detail');
