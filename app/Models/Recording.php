<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recording
 */
class Recording extends Model
{
    protected $table = 'recordings';

    public $timestamps = true;

    protected $fillable = [
        'embed',
        'title',
        'desc',
        'type',
        'order'
    ];

    protected $guarded = [];

        
}