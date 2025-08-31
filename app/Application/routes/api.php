<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::any('site/acceptConfirmationCallback2' , 'PaymentsApi@actionAcceptConfirmationCallback2');  
Route::any('site/applepay/acceptConfirmationCallback' , 'PaymentsApi@actionAcceptConfirmationCallbackApplePay');
Route::any('site/tamaraConfirmationCallback' , 'PaymentsApi@actionTamaraConfirmationCallback');
Route::any('site/FawryConfirmationCallback' , 'PaymentsApi@actionFawryConfirmationCallback');
Route::any('site/tabbyConfirmationCallback/{type?}' , 'PaymentsApi@actionTabbyConfirmationCallback');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::any('createAppCertificate', 'QuizstudentsstatusApi@createAppCertificate');


Route::group(array('prefix' => 'v1'), function () {
    require __DIR__.'/appendApi.php';
});