<?php

//Route::group(['prefix' => 'administration', 'middleware' => ['auth', 'admin']], function()
//{
//    Route::get('/', 'Admin\HomeController@index');
//});
/**
 * Web Routes
 */
Route::group(['middleware' => ['web']], function() {
    Route::auth();
    Route::group(['namespace' => 'Web'], function(){
        Route::get('/', 'IndexController@index')->name('index');

        Route::resource('stage', 'InternshipController', ['only' => ['index', 'show', 'create', 'edit']]);
        Route::resource('bedrijf', 'CompanyController', ['only' => ['index', 'show', 'create', 'edit']]);

        /**
         * todo: MAKE THIS F*CKING THING WORK!!!!!!
         */
//        Route::resource('stage', 'InternshipController', ['only' => ['index', 'show']]);
//        Route::resource('bedrijf', 'CompanyController', ['only' => ['index', 'show']]);

//        Route::group(['middleware' => ['auth']], function() {
//            Route::resource('stage', 'InternshipController', ['only' => ['create', 'edit']]);
//            Route::resource('bedrijf', 'CompanyController', ['only' => ['create', 'edit']]);
//        });
    });

    /**
     * Logged in Routes
     */
    Route::group(['middleware' => ['auth'], 'namespace' => 'Web', 'as' => 'login.'], function () {
        Route::get('accounts', 'AccountController@index')->name('accounts.index');
//        Route::post('stage', 'InternshipController@search')->name('stage.rating');

        Route::group(['middleware' => ['login'], 'as' => 'login.'], function() {
            Route::get('admin', 'AdminController@index')->name('admin.index');
        });
    });


    /**
     * Api Routes
     */
    Route::group(['middleware' => ['api'], 'namespace' => 'Api'], function() {
        Route::post('stage/search', 'InternshipController@search')->name('stage.search');
        Route::post('stage/review', 'InternshipController@review')->name('stage.review');
        Route::resource('stage', 'InternshipController', ['only' => ['store', 'update', 'destroy']]);
        Route::resource('bedrijf', 'CompanyController', ['only' => ['store', 'update', 'destroy']]);
    });
});

