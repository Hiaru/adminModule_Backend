<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

// use Illuminate\Http\Request;

/**
 * USE MANAGER SERVICE
 */
use App\Http\Services\managerService;

class managerController extends Controller
{
    /**
     * INSTANCE MANAGER SERVICE
     */
    protected $managerService;

    public function __construct(){
        $this->managerService = new managerService();
    }

    public function all_users_with_roles(Request $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_all_users_with_roles($request->database_id);
    }

    public function get_permissions_by_user(Request $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_permissions_by_user($request->user_id, $request->database_id);
    }

    public function get_roles_by_user(Request $request){

        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_roles_by_user($request->user_id, $request->database_id);
    }

    public function update_roles_by_user(Request $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->update_roles_by_user($request->user_id, $request->roles_id, $request->database_id);
    }

    public function update_user_status(Request $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->update_roles_by_user( $request->user_id, $request->roles_id, $request->database_id);
    }

    public function get_all_roles(Request $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_all_roles($request->database_id);
    }

    public function get_all_permissions(Request $request){
      /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_all_permissions($request->database_id);
    }
}
