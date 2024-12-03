<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function get_all_users_with_roles(Request $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_all_users_with_roles($request->database_id);
    }

    public function get_permissions_by_user(Request $request){
        /**
         * GET ID
         */
        $id = $request->id;

        return $this->managerService->get_permissions_by_user($id);
    }

    public function get_roles_by_user(Request $request){
        /**
         * GET ID
         */
        $id = $request->id;

        return $this->managerService->get_roles_by_user($id);
    }

    public function update_roles_by_user(Request $request){
        /**
         * GET ID OF USER AND ROLES
         */
        $user_id = $request->user_id;
        $roles_id = $request->roles_id;

        /**
         * RETURN RESPONSE
         */
        return $this->managerService->update_roles_by_user($user_id, $roles_id);
    }

    public function update_user_status(Request $request){
        /**
         * GET ID
         */
        $id = $request->id;

        return $this->managerService->update_user_status($id);
    }

    public function get_all_roles(){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_all_roles();
    }

    public function get_all_permissions(){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_all_permissions();
    }
}
