<?php
use Mxs\Routes\Route;
use App\Controllers\{
    Account as AccountController,
    Universe as UniverseController,
};
use App\Middlewares\{
    Cors as MidCors,
    Auth as MidAuth,
    AuthVerify as MidAuthVerify,
};

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell mxs the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/*
Route::group(function() {

})->middware(MidCors::class);
*/
Route::get('/auth', AccountController::class, 'verifyToken')->middware(MidCors::class, MidAuthVerify::class);
Route::post('/auth/pwd', AccountController::class, 'loginWithPwd')->middware(MidCors::class);
Route::post('/auth/regist', AccountController::class, 'regist')->middware(MidCors::class);
Route::delete('/auth', AccountController::class, 'logout')->middware(MidCors::class, MidAuth::class);

Route::put('/account/{$column}', AccountController::class, 'edit')->middware(MidCors::class, MidAuthVerify::class);

Route::get('/universe', UniverseController::class, 'getList')->middware(MidCors::class, MidAuthVerify::class);
Route::post('/universe', UniverseController::class, 'add')->middware(MidCors::class, MidAuthVerify::class);
