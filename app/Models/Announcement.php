<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Announcement
 */
class Announcement extends Model
{
    protected $table = 'announcements';

    public $timestamps = true;

    protected $fillable = [
        'message',
        'title',
        'public',
        'pub_start',
        'pub_end',
        'photo_file_name',
        'photo_content_type',
        'photo_file_size',
        'photo_updated_at',
        'text',
        'link'
    ];

    protected $guarded = [];

        
}