<?php
namespace App\Http\Controllers;
use \Illuminate\Http\Request;

class Product extends \Laravel\Lumen\Routing\Controller
{
    public function my_list( Request $request ) {
        return \App\Services\Product::GetInstance()->getListByUser( $request->me->get_id(), true );
    }

    public function public_list( Request $request ) {
        $user_id = $request->user_id;
        //  check user exists
        //  log list visit event
        return \App\Services\Product::GetInstance()->getListByUser( $user_id );
    }
}

