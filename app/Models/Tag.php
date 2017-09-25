<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 */
class Tag extends Model
{
    protected $table = 'tags';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'taggings_count'
    ];

    protected $guarded = [];

        
}