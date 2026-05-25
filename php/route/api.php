<?php
use Mxs\Routes\Route;
use App\Controllers\{
    Account as AccountController,
    Universe as UniverseController,
};
use App\Middlewares\{
    Cors as MidCors,
    Auth as MidAuth,
    CheckAccount as MidCheckAccount,
};
//  mg = middleware group
$mgCheckAccount = [MidCors::class, MidAuth::class, MidCheckAccount::class];

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

Route::head('/auth', AccountController::class, 'verifyToken')->middware(...$mgCheckAccount);
Route::post('/auth/pwd', AccountController::class, 'loginWithPwd')->middware(MidCors::class);
Route::post('/auth/regist', AccountController::class, 'regist')->middware(MidCors::class);
Route::delete('/auth', AccountController::class, 'logout')->middware(MidCors::class, MidAuth::class);

Route::put('/account/{$column}', AccountController::class, 'edit')->middware(...$mgCheckAccount);

Route::get('/universe', UniverseController::class, 'getList')->middware(...$mgCheckAccount);
Route::post('/universe', UniverseController::class, 'add')->middware(...$mgCheckAccount);
