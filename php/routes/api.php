<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return '&copy; '.date( 'Y' ).', Creages';
});

$router->group( [
    'middleware' => [ 'auth' ],
    'prefix' => 'product',
    //  'namespace' => 'Product'
], function() use ( $router ) {
    $router->get( 'my_list', 'Product@my_list' );
    $router->get( 'pub_list', 'Product@public_list' );
} );

