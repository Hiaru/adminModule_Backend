<?php

namespace App\Http\Services;

/**
 * MODELS
 */
use App\Models\Databases\users_databasesModel as users_databases;

class usersDatabasesService {

    /**
     * GET ALL NAMES ABOUT DATABASES FOR SELECTORS
     *
     * @return mixed
     */
    public function get_databases_names(){

        /**
         * GET ALL USER WITH HIS ROLES
         */
        $databases = users_databases::all(['id', 'description']);

        /**
         * RETURN RESPONSE
         */
        return response()->json([
            'status' => true,
            'message' => 'Información obtenida satisfactoriamente',
            'data' => $databases
        ], 200);
    }
}
