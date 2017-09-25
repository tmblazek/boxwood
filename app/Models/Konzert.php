<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Konzert
 */
class Konzert extends Model
{
    protected $table = 'konzerts';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'date',
        'start_time',
        'end_time',
        'dest'
    ];

    protected $guarded = [];

        
}