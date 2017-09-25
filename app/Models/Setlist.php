<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setlist
 */
class Setlist extends Model
{
    protected $table = 'setlists';

    public $timestamps = true;

    protected $fillable = [
        'konzert_id',
        'setlist',
        'title',
        'michi'
    ];

    protected $guarded = [];

        
}