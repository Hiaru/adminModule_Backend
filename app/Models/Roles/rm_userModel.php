<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles\rmRoleModel as Role;
use App\Models\Roles\rmPermissionModel as Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
//Namespace for Laravel Spatie
use Spatie\Permission\Traits\HasRoles;

class rm_userModel extends Model
{
    use HasRoles;

    /**
     * USE SCHEMA security
     */
    protected $connection =     'risk_matrix';
    protected $table =          'users';
    protected $schema =         'security';

    protected $fillable = [
        'name',
        'lastname',
        'username',
        'pcc',
        'email',
        'unit',
        'password',
        'accAuthorized',
        'last_activity',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * GET ALL USERS WITH HIS ROLES
     */
    public function get_all_users_with_roles(){
        /**
         * GET ALL ROLES BY USER
         */
        // $roles  = DB::connection('risk_matrix')->select('
        //             SELECT users.username, users.name, users.lastname, users.pcc, users.unit, users.accAuthorized,
        //             roles.id, roles.name, roles.memo
        //             FROM users
        //             JOIN roles ON model_has_roles.role_id = roles.id
        //             WHERE model_has_roles.model_id = users.id
        //         ', []);

        $users  = DB::connection('risk_matrix')->table('users')
                        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                        ->select('users.id' ,'users.username', 'users.name', 'users.lastname', 'users.pcc', 'users.unit', 'users.accAuthorized', 'roles.id as role_id', 'roles.name as role_name', 'roles.memo as role_memo')
                        ->get();

        /**
         * RETURN DATA
         */
        return $users->toArray();
    }


    /**
     * GET ALL ROLES BY USER
     */
    public function get_roles_by_user($id)
    {
        /**
         * GET ACTUAL USER
         */
        $user = $this::on('risk_matrix')->find($id);

        /**
         * GET ALL ROLES BY USER
         */
        $roles  = DB::connection('risk_matrix')->table('roles')
                    ->join('model_has_roles as mhr1', 'mhr1.role_id', '=', 'roles.id')
                    ->join('model_has_roles as mhr2', 'mhr2.model_id', '=', 'mhr1.model_id')
                    ->where('mhr2.model_id', $user->id)
                    ->select('roles.id', 'roles.name', 'roles.memo')
                    ->get();

        /**
         * RETURN DATA
         */
        return $roles->toArray();
    }

    /**
     * GET ALL PERMISSIONS BY USER
     */
    public function get_permissions_by_user($id){
        /**
         * GET ACTUAL USER
         */
        $user = $this::on('risk_matrix')->find($id);

        /**
         * GET ROLES BY USER
         */
        $roles = $user->get_roles_by_user($user->id);

        /**
         * GET ALL PERMISSIONS BY ROLE
         */
        $rolePermissions = [];
        foreach ($roles as $role){
            // $permissions = DB::connection('risk_matrix')->select('
            //                     SELECT permissions.id, permissions.name, permissions.category, permissions.url, permissions.memo
            //                     FROM role_has_permissions
            //                     JOIN permissions ON role_has_permissions.permission_id = permissions.id
            //                     WHERE role_has_permissions.role_id = ?
            //                 ', [$role->id]);

            $permissions = DB::connection('risk_matrix')->table('permissions')
                                ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->select('permissions.id', 'permissions.name', 'permissions.category', 'permissions.url', 'permissions.memo')
                                ->get();

            /**
             * PUSH TO ARRAY RESPONSE
             */
            $rolePermissions = array_merge($rolePermissions , $permissions->toArray());
        }

        /**
         * RETURN DATA
         */
        return $rolePermissions;
    }

    /**
     * UPDATE USER ROLES
     */
    public function update_roles_by_user($user_id, $roles_id){
        /**
         * GET ACTUAL USER
         */
        $user = $this::on('risk_matrix')->find($user_id);

        /**
         * GET ROLES BY USER
         */
        $roles = $user->get_roles_by_user($user->id);

        /**
         * REMOVE ALL ROLES BY USER
         */
        foreach ($roles as $key => $value) {
            DB::connection('risk_matrix')->table('model_has_roles')
                ->where('model_id', $user_id)
                ->where('role_id', $value->id)
                ->delete();
        }

         /**
          * ADD NEW ROLES BY USER
          */
        foreach ($roles_id as $key => $value) {
            DB::connection('risk_matrix')->table('model_has_roles')
                ->insert([
                    ['model_id' => $user_id, 'model_type' => 'App\Models\userModel', 'role_id' => $value]
                ]);
        }
    }

    /**
     * CHANGE USER STATUS
     */
    public function update_user_status($id){
        /**
         * GET ACTUAL USER
         */
        $user = $this::on('risk_matrix')->find($id);

        /**
         * CHANGE STATUS USER
         */
        DB::connection('risk_matrix')->table('users')
                ->where('id', $user->id)
                ->update(['accAuthorized' =>!$user->accAuthorized]);

<<<<<<< HEAD
        /**
         * GET ACTUAL USER
         */
        $user = $this::on('risk_matrix')->find($id);
=======
>>>>>>> c14f9ebfc8c78c1815c1d3ac128417941633004b
    }

    /**
     * GET ROLE
     */
    public function get_role($id){
        /**
         * GET DATA
         */
        $role = DB::connection('risk_matrix')->table('roles')
                            ->where('id', $id)
                            ->select('roles.id', 'roles.name', 'roles.memo')
                            ->first();


        /**
         * RETURN DATA
         */
        return $role;
    }

    /**
     * GET ALL ROLES
     */
    public function get_all_roles(){
        /**
         * GET DATA
         */
        $roles = DB::connection('risk_matrix')->table('roles')
                            ->select('roles.id', 'roles.name', 'roles.memo')
                            ->get();


        /**
         * RETURN DATA
         */
        return $roles->toArray();
    }

    /**
     * GET ALL PERMISSIONS
     */
    public function get_all_permissions(){
        /**
         * GET DATA
         */
        $permissions = DB::connection('risk_matrix')->table('permissions')
                            ->select('permissions.id', 'permissions.name', 'permissions.category', 'permissions.url', 'permissions.memo')
                            ->get();


        /**
         * RETURN DATA
         */
        return $permissions->toArray();
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    //Encrypt users password - Mutator
    // public function setPasswordAttribute($value){
    //     $this->attributes['password'] = bcrypt($value);
    // }
}
