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

    public function setlists()
    {
        return $this->belongsToMany('App\Models\Setlist', 'setlists_tunes');
    }

    /**
     *
     */
    public function abc_for_js(){
        $abc = $this->abc;
        $abc = str_replace("\r", "", $abc);
        $abc = str_replace("\n", "\\n", $abc);
        $abc = str_replace("\"", "\\\"", $abc);
        return $abc;
    }
}