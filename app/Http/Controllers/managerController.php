<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\managerRequest;

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

    public function all_users_with_roles(managerRequest $request){
        \Log::info('Request received:', $request->all());
        return response()->json([
            'status' => false,
            'errorTitle' => 'Uno o más campos están vacíos',
        ], 400);
        // return response()->json([
        //     'status'        =>  true,
        //     'message'       =>  'Usuario autenticado satisfactoriamente',
        //     'data'          =>  'help'
        // ], 200);
        /**
         * RETURN RESPONSE
         */
        // return $this->managerService->get_all_users_with_roles($request->database_id);
    }

    public function get_permissions_by_user(managerRequest $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_permissions_by_user($request->user_id, $request->database_id);
    }

    public function get_roles_by_user(managerRequest $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_roles_by_user($request->user_id, $request->database_id);
    }

    public function update_roles_by_user(managerRequest $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->update_roles_by_user( $request->user_id, $request->roles_id, $request->database_id);
    }

    public function update_user_status(managerRequest $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->update_user_status($request->user_id, $request->database_id);
    }

    public function get_all_roles(managerRequest $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_all_roles($request->database_id);
    }

    public function get_all_permissions(managerRequest $request){
        /**
         * RETURN RESPONSE
         */
        return $this->managerService->get_all_permissions($request->database_id);
    }
}
