<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreAmenity extends Model
{
    protected $table = 'core_amenities';

    protected $fillable = [
        'title',
        'icon',
        'status',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
