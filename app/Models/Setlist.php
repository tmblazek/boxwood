<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Konzerte;
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
}