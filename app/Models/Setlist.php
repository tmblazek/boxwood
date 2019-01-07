<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Konzerte;
use App\Models\Tune;

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
    function full_title () {
        return Konzerte::find($this->konzert_id)->title.' '.$this->title;
    }
    public function opening()
    {
        return substr($this->konzert->start_t, 0, 19);
    }
    public function konzert()
    {
        return $this->belongsTo('App\Models\Konzerte');
    }
    public function sync_tunes()
    {

            $this->tunes()->detach();

        foreach ($this->getTunesOrdered() as $t){
            $this->tunes()->attach($t);
        }
        return 0;
    }
    public function tunes()
    {
        return $this->belongsToMany('App\Models\Tune', 'setlists_tunes');
    }
    public function getTunesOrdered(){
        $ids =array_map('intval', explode("tune", str_replace(x"|", "", $this->setlist)));
        $out = new Collection();
        foreach($ids as $id){
            if ($id === 0)
                continue;
            $out->push(Tune::find($id));
        }
        return $out;
    }
}
