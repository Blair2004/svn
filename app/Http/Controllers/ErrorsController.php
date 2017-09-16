<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function index( $code ) 
    {
        return view( 'errors.page', compact( 'code' ) );
    }
}
