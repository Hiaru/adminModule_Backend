<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;


class customPersonalAccessToken extends PersonalAccessToken
{
    use HasFactory;

    /**
     * USE SCHEMA security
     */
    protected $connection =     'security';
    protected $table =          'personal_access_tokens';
    protected $schema =         'security';
}
