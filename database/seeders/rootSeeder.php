<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * USE ROOT MODEL
 */
use App\Models\config\rootModel as root;

class rootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * TESTING USER
         */
        root::create([
            'username' => 'root01',
            'name' => 'root',
            'lastname' => 'user',
            'password' => 'Root.01',
            'accAuthorized' => true,
        ]);
    }
}
