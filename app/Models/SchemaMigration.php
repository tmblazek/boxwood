<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SchemaMigration
 */
class SchemaMigration extends Model
{
    protected $table = 'schema_migrations';

    public $timestamps = false;

    protected $fillable = [
        'version'
    ];

    protected $guarded = [];

        
}