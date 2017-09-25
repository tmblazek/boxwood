<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tagging
 */
class Tagging extends Model
{
    protected $table = 'taggings';

    public $timestamps = true;

    protected $fillable = [
        'tag_id',
        'taggable_id',
        'taggable_type',
        'tagger_id',
        'tagger_type',
        'context'
    ];

    protected $guarded = [];

        
}