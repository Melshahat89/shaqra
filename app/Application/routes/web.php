<?php
Route::group(['prefix' => LaravelLocalization::setLocale() , 'middleware' => ['localeSessionRedirect', 'localizationRedirect']] , function(){
    Route::group(['prefix' =>'lazyadmin' , 'namespace' => 'Admin' ,'middleware' => ['auth','admin' , 'admin-permissions']] , function() {
        require_once __DIR__ . '/admin.php';
    });
    Route::group([ 'namespace' => 'Website'] , function() {
        require_once __DIR__ . '/visitor.php';
        Route::group(['middleware' => ['auth' , 'website-permissions']] , function(){
//            require_once __DIR__ . '/auth.php';
            require_once __DIR__ . '/appendWebsite.php';
        });
        Route::group(['middleware' => ['auth']] , function(){
            require_once __DIR__ . '/auth.php';
        });

        Route::middleware(['auth.token'])->group(function () {
            Route::get('/cart', [\App\Application\Controllers\Website\HomeController::class, 'cart']);
        });
    });
});
require_once __DIR__.'/errors.php';

Route::get('{category}/{slug?}', 'Website\HomeController@posts');







Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
