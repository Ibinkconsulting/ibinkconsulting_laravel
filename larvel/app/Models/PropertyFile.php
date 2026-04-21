<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyFile extends Model
{
    protected $table = 'property_files';

    protected $fillable = [
        'property_id',
        'file_path',
        'is_primary',
    ];

    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        return asset($this->file_path);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
