<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Minute
 */
class Minute extends Model
{
    protected $table = 'minutes';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'content'
    ];

    protected $guarded = [];

        
}