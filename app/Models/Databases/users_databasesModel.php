<?php

namespace App\Models\Databases;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_databasesModel extends Model
{
    use HasFactory;

    /**
     * USE SCHEMA security
     */
    protected $connection =     'security';
    protected $table =          'users_databases';
    protected $schema =         'security';

    protected $fillable = [
        'database_name',
        'title',
        'description',
        'model'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
