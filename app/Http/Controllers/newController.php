<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class newController extends Controller
{
    public function index(){
        return response()->json([
            'status'        =>  true,
            'message'       =>  'Usuario autenticado satisfactoriamente',
            'data'          =>  'Chucha'
        ], 201);
    }
}
