<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

/**
 * USE LOGIN SERVICE AND REQUEST
 */
use App\Http\Services\auth\loginService;
use App\Http\Requests\auth\loginRequest;

class loginController extends Controller
{
    /**
     * INSTANCE LOGIN SERVICE
     */
    protected $loginService;

    public function __construct(){
        $this->loginService = new loginService();
    }

    public function login(loginRequest $request){
        return $this->loginService->login($request);
    }

    public function logout(){
        return $this->loginService->logout();
    }
<<<<<<< HEAD
=======

    public function test(loginRequest $request){
        return response()->json([
            'status'        =>  true,
            'message'       =>  'Usuario autenticado satisfactoriamente',
            'data'          =>  'Chucha'
        ], 201);
    }
>>>>>>> c14f9ebfc8c78c1815c1d3ac128417941633004b
}
