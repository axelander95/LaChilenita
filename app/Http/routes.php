<?php


Route::group(['middleware' => ['web']], function () {
    Route::resource('/install', 'InstallController', ['only' => ['index', 'store']]);
});

Route::group(['middleware' => ['web', 'install']], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::get('/', function () {
        return view('welcome');
    });
});
Route::group(['prefix' => 'api/v1'], function () {
    //rutas para los roles (api)
    Route::resource('/roles', 'Api\v1\RoleApiController', ['only' => ['index', 'show']]);
    //rutas para los usuarios (api)
    Route::resource('/users', 'Api\v1\UserApiController', ['except' => ['create', 'edit']]);
    //rutas para los círculos (api)
    Route::resource('/circles', 'Api\v1\CircleApiController', ['except' => ['create', 'edit']]);
    //rutas para los estados de visita (api)
    Route::resource('/visit-statuses', 'Api\v1\VisitStatusApiController', ['only' => ['index', 
    'show']]);
    //rutas para los clientes (api)
    Route::resource('/customers', 'Api\v1\CustomerApiController', ['except' => ['create', 'edit']]);
});
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'install', 'auth', 'admin']], function () {
    Route::get('/', 'DashboardController@index');
    Route::post('/users/search/', 'Admin\UserController@search');
    Route::resource('/users', 'Admin\UserController');
    Route::post('/circles/search/', 'Admin\CircleController@search');
    Route::resource('/circles', 'Admin\CircleController');
    Route::post('/customers/search/', 'Admin\CustomerController@search');
    Route::resource('/customers', 'Admin\CustomerController');
});
Route::group(['prefix' => 'supervisor', 'middleware' => ['web', 'install', 'auth', 'supervisor']], function () {
    Route::get('/', 'Supervisor\CircleController@index');
    Route::get('/visits/{id}/create', 'Supervisor\CircleController@create');
    Route::resource('/visits', 'Supervisor\CircleController');
});
