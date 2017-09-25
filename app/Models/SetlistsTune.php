<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SetlistsTune
 */
class SetlistsTune extends Model
{
    protected $table = 'setlists_tunes';

    public $timestamps = false;

    protected $fillable = [
        'setlist_id',
        'tune_id'
    ];

    protected $guarded = [];

        
}