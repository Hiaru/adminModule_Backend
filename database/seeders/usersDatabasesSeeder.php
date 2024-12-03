<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * USE USERS DATABASES MODEL
 */
use App\Models\Databases\users_databasesModel as users_databases;

class usersDatabasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        users_databases::create([
            'database_name'     =>  'matriz_de_riesgos_dev',
            'title'             =>  'risk_matrix',
            'description'       =>  'Matriz de Riesgos',
            'model'             =>  'rm_userModel'
        ]);
    }
}
