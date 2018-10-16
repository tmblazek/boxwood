<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tune
 */
use App\Models\Tagging;
use App\Models\Tag;
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
        if ($tag_id == null)
            return false;
        return null !== Tagging::where('taggable_id', '=', $this->id)
            ->where('tag_id', '=', $tag_id->id)->get()->first();
    }
    public function remove_tagging($tag_name){
        if (!$this->has_tag($tag_name))
            return;
        $tag = Tag::where('name', $tag_name)->get()->first();
        $tagging = Tagging::where('tag_id', $tag->id)
            ->where('taggable_id', $this->id)->get()->first();
        $tagging->delete();
        $tag->taggings_count = sizeof(Tagging::where('tag_id', $tag->id)->get());
        $tag->save();
        if ($tag->taggings_count==0)
            $tag->delete();
    }
    public function set_new_tags($tag_array){
        foreach ($this->get_tags() as $old){
            if (!in_array($old->name, $tag_array )){
                $this->remove_tagging($old->name);
            }
        }
        foreach ($tag_array as $tag_name){
            $this->add_tagging($tag_name);
        }
    }
    public function add_tagging($tag_name){
        if ($this->has_tag($tag_name))
            return;
        $tag = Tag::where('name', $tag_name)->get()->first();
        if ($tag==null){
            $tag = new Tag;
            $tag->name = $tag_name;
            $tag->taggings_count = 0;
            $tag->save();
        }
        $tag->taggings_count = sizeof(Tagging::where('tag_id', $tag->id)->get());
        $tag->save();
        $tagging = new Tagging;
        $tagging->tag_id = $tag->id;
        $tagging->taggable_id = $this->id;
        $tagging->taggable_type = "Tune";
        $tagging->save();
        $tag->taggings_count = sizeof(Tagging::where('tag_id', $tag->id)->get());
        $tag->save();
    }
    public static function find_by_tag_string($tag_string){
        foreach(explode("|", $tag_string) as $index => $tag_name){
            if ($index==0) {
                $tune_set = Tune::find_by_tags($tag_name);
            } else {
                $tune_set->union(Tune::find_by_tags($tag_name));
            }

        }
        return $tune_set;
    }
    public static function find_by_tags($tag_name){
        if (null === Tag::where('name', $tag_name)->get()->first()){
            return self::all()->filter(function ($t){return !(substr($t->title,0,3)=== "---");});
        }
        return self::all()->filter(function($tune) use ($tag_name) {return Tagging::tagging_exists($tag_name, $tune->id);});
    }
    public static function all_for_setlists(){
        $ret = '[';
        foreach(self::all() as $index=>$tune){
            $ret = $ret.'"<div class=\"tune'.$tune->id.'\"><b>'.$tune->title.'</b><br><div class=\"sl_from_tags\">|';
            foreach($tune->get_tags() as $tag){
                $ret = $ret.$tag->name.'|';
            }
            $ret = $ret.'</div></div>"';
            if($index < (Tune::all()->count() - 1)){
                $ret = $ret.',';
            }

        }
        $ret = $ret.']';
        return $ret;
    }
    public function abc_for_js(){
        $abc = $this->abc;
        $abc = str_replace("\r", "", $abc);
        $abc = str_replace("\n", "\\n", $abc);
        $abc = str_replace("\"", "\\\"", $abc);
        return $abc;
    }
}