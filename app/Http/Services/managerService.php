<?php

namespace App\Http\Services;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * MODELS
 */
use App\Models\Roles\rm_userModel as rm_user;
use App\Models\Databases\users_databasesModel as users_databases;

use function PHPUnit\Framework\empty;

class managerService {

    /**
     * Get all users from the database
     *
     * @return mixed
     */
    public function get_all_users_with_roles($database_id){
        /**
         * CHECK DATABASE ID
         */
        if($database_id === null || $database_id === '' || $database_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id de la base de datos a seleccionar es requerido'
            ], 400);
        }

        /**
         * GET DATABASE MODEL
         */
        $model = users_databases::where('id', $database_id)->get('model')->first();

        /**
         * CHECK IF DATABASE EXISTS
         */
        if(empty($model)){
            return response()->json([
                'status' => false,
                'errorTitle' => 'Base de datos no encontrada'
            ], 400);
        }

        /**
         * GET ALL USER WITH HIS ROLES
         */
        switch ($model->model) {
            case 'rm_userModel':
                $users = (new rm_user)->get_all_users_with_roles();
            break;

            default:
                # code...
            break;
        }

        /**
         * RETURN RESPONSE
         */
        return response()->json([
            'status' => true,
            'message' => 'Información obtenida satisfactoriamente',
            'data' => $users
        ], 200);
    }

    /**
     * GET ROLES BY USER
     */
    public function get_roles_by_user($user_id, $database_id){
        /**
         * CHECK ID
         */
        if($user_id === null || $user_id === '' || $user_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id del usuario es requerido'
            ], 400);
        }

        /**
         * CHECK DATABASE ID
         */
        if($database_id === null || $database_id === '' || $database_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id de la base de datos a seleccionar es requerido'
            ], 400);
        }

        /**
         * GET DATABASE MODEL
         */
        $model = users_databases::where('id', $database_id)->get('model')->first();

        /**
         * CHECK IF DATABASE EXISTS
         */
        if(empty($model)){
            return response()->json([
                'status' => false,
                'errorTitle' => 'Base de datos no encontrada'
            ], 400);
        }

        switch ($model->model) {
            case 'rm_userModel':
                /**
                 * GET USER
                 */
                $user = rm_user::on('risk_matrix')->find($user_id);

                /**
                 * CHECK USER
                 */
                if(!$user){
                    return response()->json([
                        'status' => false,
                        'errorTitle' => 'Usuario no encontrado'
                    ], 400);
                }

                /**
                 * GET DATA
                 */
                $role_names = $user->get_roles_by_user($user->id);
            break;

            default:
                # code...
            break;
        }

        /**
         * RETURN RESPONSE
         */
        return response()->json([
            'status' => true,
            'message' => 'Información obtenida satisfactoriamente',
            'data' => $role_names
        ], 200);
    }

    /**
     * GET ALL PERMISSIONS BY USER
     */
    public function get_permissions_by_user($user_id, $database_id){
        /**
         * CHECK ID
         */
        if($user_id === null || $user_id === '' || $user_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id del usuario es requerido'
            ], 400);
        }

        /**
         * CHECK DATABASE ID
         */
        if($database_id === null || $database_id === '' || $database_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id de la base de datos a seleccionar es requerido'
            ], 400);
        }

        /**
         * GET DATABASE MODEL
         */
        $model = users_databases::where('id', $database_id)->get('model')->first();

        /**
         * CHECK IF DATABASE EXISTS
         */
        if(empty($model)){
            return response()->json([
                'status' => false,
                'errorTitle' => 'Base de datos no encontrada'
            ], 400);
        }

        /**
         * CHECK IF DATABASE EXISTS
         */
        if(empty($model)){
            return response()->json([
                'status' => false,
                'errorTitle' => 'Base de datos no encontrada'
            ], 400);
        }

        switch ($model->model) {
            case 'rm_userModel':
                /**
                 * GET USER
                 */
                $user = rm_user::on('risk_matrix')->find($user_id); // Replace $userId with the actual user ID

                /**
                 * CHECK USER
                 */
                if(!$user){
                    return response()->json([
                        'status' => false,
                        'errorTitle' => 'Usuario no encontrado'
                    ], 400);
                }

                /**
                 * GET DATA
                 */
                $permissions = $user->get_permissions_by_user($user->id);
            break;

            default:
                # code...
            break;
        }

        /**
         * RETURN RESPONSE
         */
        return response()->json([
            'status' => true,
            'message' => 'Información obtenida satisfactoriamente',
            'data' => $permissions
        ], 200);
    }

    /**
     * UPDATE USER ROLES
     */
    public function update_roles_by_user($user_id, $roles_id, $database_id){
        /**
         * CHECK ID
         */
        if($user_id === null || $user_id === '' || $user_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id del usuario es requerido'
            ], 400);
        }

        /**
         * CHECK DATABASE ID
         */
        if($database_id === null || $database_id === '' || $database_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id de la base de datos a seleccionar es requerido'
            ], 400);
        }

        /**
         * CHECK ID ROLES
         */
        if($roles_id === null || $roles_id === '' || $roles_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id de los roles es requerido'
            ], 400);
        }

        /**
         * GET DATABASE MODEL
         */
        $model = users_databases::where('id', $database_id)->get('model')->first();

        /**
         * CHECK IF DATABASE EXISTS
         */
        if(empty($model)){
            return response()->json([
                'status' => false,
                'errorTitle' => 'Base de datos no encontrada'
            ], 400);
        }

        switch ($model->model) {
            case 'rm_userModel':
                /**
                 * FIND USER
                 */
                $user = rm_user::on('risk_matrix')->find($user_id);

                /**
                 * CHECK USER
                 */
                if(!$user){
                    return response()->json([
                        'status' => false,
                        'errorTitle' => 'Usuario no encontrado'
                    ], 400);
                }

                /**
                 * CHECK ROLES
                 */
                foreach ($roles_id as $key => $value) {
                    $role = $user->get_role($value);

                    if(!$role){
                        return response()->json([
                            'status' => false,
                            'errorTitle' => 'Uno o más roles no se encontraron'
                        ], 400);
                    }
                }

                /**
                 * CHANGE ROLES BY USER
                 */
                $user->update_roles_by_user($user->id, $roles_id);
            break;

            default:
                # code...
            break;
        }

        /**
         * RETURN RESPONSE
         */
        return response()->json([
            'status' => true,
            'message' => 'Usuario actualizado satisfactoriamente'
        ], 200);
    }

    /**
     * DISABLE / ENABLE USER
     */
    public function update_user_status($user_id, $database_id){
        /**
         * CHECK ID
         */
        if($user_id === null || $user_id === '' || $user_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id del usuario es requerido'
            ], 400);
        }

        /**
         * CHECK DATABASE ID
         */
        if($database_id === null || $database_id === '' || $database_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id de la base de datos a seleccionar es requerido'
            ], 400);
        }

        /**
         * GET DATABASE MODEL
         */
        $model = users_databases::where('id', $database_id)->get('model')->first();

        /**
         * CHECK IF DATABASE EXISTS
         */
        if(empty($model)){
            return response()->json([
                'status' => false,
                'errorTitle' => 'Base de datos no encontrada'
            ], 400);
        }

        switch ($model->model) {
            case 'rm_userModel':
                /**
                 * FIND USER
                 */
                $user = rm_user::on('risk_matrix')->find($user_id);

                /**
                 * CHECK USER
                 */
                if(!$user){
                    return response()->json([
                        'status' => false,
                        'errorTitle' => 'Usuario no encontrado'
                    ], 400);
                }

                /**
                 * ENABLE OR DISABLE USER
                 */
                $user->update_user_status($user->id);
            break;

            default:
                # code...
            break;
        }

        /**
         * RETURN RESPONSE
         */
        return response()->json([
            'status' => true,
            'message' => 'Usuario actualizado satisfactoriamente'
        ], 200);
    }

    /**
     * GET ALL ROLES
     */
    public function get_all_roles($database_id){
        /**
         * CHECK DATABASE ID
         */
        if($database_id === null || $database_id === '' || $database_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id de la base de datos a seleccionar es requerido'
            ], 400);
        }

        /**
         * GET DATABASE MODEL
         */
        $model = users_databases::where('id', $database_id)->get('model')->first();

        /**
         * CHECK IF DATABASE EXISTS
         */
        if(empty($model)){
            return response()->json([
                'status' => false,
                'errorTitle' => 'Base de datos no encontrada'
            ], 400);
        }

        switch ($model->model) {
            case 'rm_userModel':
                /**
                 * GET DATA
                 */
                $roles = (new rm_user)->get_all_roles();
            break;

            default:
                # code...
            break;
        }

        /**
         * RETURN RESPONSE
         */
        return response()->json([
            'status' => true,
            'message' => 'Información obtenida satisfactoriamente',
            'data' => $roles
        ], 200);
    }

    /**
     * GET ALL PERMISSIONS
     */
    public function get_all_permissions($database_id){
        /**
         * CHECK DATABASE ID
         */
        if($database_id === null || $database_id === '' || $database_id === false){
            return response()->json([
                'status' => false,
                'errorTitle' => 'El id de la base de datos a seleccionar es requerido'
            ], 400);
        }

        /**
         * GET DATABASE MODEL
         */
        $model = users_databases::where('id', $database_id)->get('model')->first();

        /**
         * CHECK IF DATABASE EXISTS
         */
        if(empty($model)){
            return response()->json([
                'status' => false,
                'errorTitle' => 'Base de datos no encontrada'
            ], 400);
        }

        switch ($model->model) {
            case 'rm_userModel':
                /**
                 * GET DATA
                 */
                $permissions = (new rm_user)->get_all_permissions();
            break;

            default:
                # code...
            break;
        }

        /**
         * RETURN RESPONSE
         */
        return response()->json([
            'status' => true,
            'message' => 'Información obtenida satisfactoriamente',
            'data' => $permissions
        ], 200);
    }
}

