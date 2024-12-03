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
}
