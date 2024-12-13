<?php

namespace App\Http\Services\auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * USE ROOT MODEL
 */
use App\Models\config\rootModel as root;

class loginService{
    public function login($data){
        /**
         * DATA VALIDATION
         */
        $validator = Validator::make($data->all(),
        [
            'username' =>   'required',
            'password' =>   'required'
        ],
        [
            'username.required' => 'El nombre de usuario es requerido.',
            'password.required' => 'La contraseña es requerida.',
        ]
        );

        /**
         * RETURNS ERROR'S
         */
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errorTitle' => 'Uno o más campos están vacíos',
                'errors' => $validator->errors()->toArray()
            ], 400);
        }

        /**
         * GET CREDENTIALS
         */
        $credentials = $data->getCredentials();
        $credentials['username'] = strtolower($credentials['username']);

        /**
         * VERIFY IF USER IS DISABLED
         */
        $record = root::where('username', $credentials['username'])->first();
        if($record){
            if(!$record->accAuthorized){
                return response()->json([
                    'status'    =>  false,
                    'errorTitle' => 'El usuario se encuentra deshabilitado, contáctese con un administrador.',
                ], 423);
            /**
             * ATTEMPT TO AUTHENTICATE
             */
            }elseif(Auth::attempt($credentials)){
                /**
                 * GET DATA ABOUT USER
                 */
                $user = Auth::user();
                $user->createToken('API TOKEN')->plainTextToken;

                /**
                 * SET LAST ACTIVITY
                 */
                // $record->last_activity = time();
                // $record->update([
                //     'last_activity' => time()
                // ]);

                return response()->json([
                    'status'        =>  true,
                    'message'       =>  'Usuario autenticado satisfactoriamente',
                    'data'          =>  $user,
                    'token'         =>  $user->createToken('API TOKEN')->plainTextToken,
                ], 200);
            }else{
                /**
                 * BAD CREDENTIALS
                 */
                return response()->json([
                    'status'    =>  false,
                    'errorTitle' => 'Datos incorrectos',
                ], 400);
            }
        }else{
            /**
             * BAD CREDENTIALS
             */
            return response()->json([
                'status'    =>  false,
                'errorTitle' => 'Datos incorrectos',
            ], 400);
        }
        dd("here");
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
           'status' => true,
           'message' => 'Usuario desconectado'
        ], 200);
    }
}
