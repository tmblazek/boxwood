<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersRole
 */
class UsersRole extends Model
{
    protected $table = 'users_roles';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    protected $guarded = [];

        
}