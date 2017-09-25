<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AnnouncementsKonzerte
 */
class AnnouncementsKonzerte extends Model
{
    protected $table = 'announcements_konzerte';

    public $timestamps = false;

    protected $fillable = [
        'announcement_id',
        'konzert_id'
    ];

    protected $guarded = [];

        
}