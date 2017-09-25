<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CkeditorAsset
 */
class CkeditorAsset extends Model
{
    protected $table = 'ckeditor_assets';

    public $timestamps = true;

    protected $fillable = [
        'data_file_name',
        'data_content_type',
        'data_file_size',
        'assetable_id',
        'assetable_type',
        'type',
        'width',
        'height'
    ];

    protected $guarded = [];

        
}