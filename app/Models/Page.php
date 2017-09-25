<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 */
class Page extends Model
{
    protected $table = 'pages';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'content',
        'photo_file_name',
        'photo_content_type',
        'photo_file_size',
        'photo_updated_at',
        'datei_file_name',
        'datei_content_type',
        'datei_file_size',
        'datei_updated_at',
        'tag',
        'tags',
        'photocredit',
        'show_order'
    ];

    protected $guarded = [];

        
}