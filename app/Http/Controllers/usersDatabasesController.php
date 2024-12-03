<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * USE USERS DATABASES SERVICE
 */
use App\Http\Services\usersDatabasesService;

class usersDatabasesController extends Controller
{
    /**
     * INSTANCE MANAGER SERVICE
     */
    protected $usersDatabasesService;

    public function __construct(){
        $this->usersDatabasesService = new usersDatabasesService();
    }

    function get_databases_names(){
        /**
         * RETURN RESPONSE
         */
        return $this->usersDatabasesService->get_databases_names();
    }

}
