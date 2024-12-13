<?php

namespace App\Models\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
USe Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class rootModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * USE SCHEMA security
     */
    protected $connection   =   'security';
    protected $table        =   'root';
    protected $schema       =   'security';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $fillable = [
        'name',
        'lastname',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'accAuthorized',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    /**
     * ENCRYPT/DECRYPT USER PASSWORD -> MUTATOR
     */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * USERNAME IN LOWER CASE
     */
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }
}
