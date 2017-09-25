<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tune
 */
class Tune extends Model
{
    protected $table = 'tunes';

    public $timestamps = true;

    protected $fillable = [
        'abc',
        'title',
        'general_notes',
        'status',
        'songtext',
        'tonart',
        'typ',
        'michi'
    ];

    protected $guarded = [];

        
}