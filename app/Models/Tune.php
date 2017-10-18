<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tune
 */
use App\Models\Tagging;

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
    public function get_tags(){
        return Tagging::tags_for_id($this->id);
    }
    public function has_tag($tag){
        $tag_id = Tag::where('name', $tag)->get()->first();
        return !Tagging::where('taggable_id', '=', $this->id)
            ->where('tag_id', '=', $tag_id)->get();
    }
    public static function find_by_tags($tag_name){
        if (null === Tag::where('name', $tag_name)->get()->first()){
            return self::all();
        }
        return self::all()->filter(function($tune) use ($tag_name) {return Tagging::tagging_exists($tag_name, $tune->id);});
    }
    public function abc_for_js(){
        $abc = $this->abc;
        $abc = str_replace("\r", "", $abc);
        $abc = str_replace("\n", "\\n", $abc);
        $abc = str_replace("\"", "\\\"", $abc);
        return $abc;
    }
}