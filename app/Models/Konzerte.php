<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Konzerte
 */
class Konzerte extends Model
{
    protected $table = 'konzerte';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'dest',
        'place',
        'address',
        'plakat_file_name',
        'plakat_content_type',
        'plakat_file_size',
        'plakat_updated_at',
        'placeurl',
        'city',
        'region',
        'postal',
        'country',
        'price',
        'photocredit',
        'start_t',
        'end_t',
        'qr_c_file_name',
        'qr_c_content_type',
        'qr_c_file_size',
        'qr_c_updated_at',
        'dismaps',
        'pinned',
        'hidden',
        'announcements_id',
        'public',
        'band'
    ];

    protected $guarded = [];

    public function setlist()
    {
        return $this->hasOne('App\Models\Setlist');
    }
}