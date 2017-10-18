<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
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
    public static function tags_for_id($id){
        $tags = self::where('taggable_id', $id)->get()->map(function($t){return Tag::find($t->tag_id);});
        return $tags;

    }
    public static function tagging_exists($tag_name, $taggable_id){
        $tag_id = Tag::where('name','=', $tag_name)->get()->first()->id;
        return null !== self::where('tag_id', $tag_id)->where('taggable_id', $taggable_id)->first();
    }
}