<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Biography
 */
class Biography extends Model
{
    protected $table = 'biographies';

    public $timestamps = true;

    protected $fillable = [
        'image_url',
        'name',
        'instruments',
        'short_desc',
        'long_desc',
        'photo_file_name',
        'photo_content_type',
        'photo_file_size',
        'photo_updated_at',
        'frontpage',
        'photocredit'
    ];

    protected $guarded = [];

        
}