<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'price',
        'location',
        'city',
        'land_size',
        'floor_size',
        'bedrooms',
        'bathrooms',
        'garages',
        'open_spaces',
        'establishment_year',
        'description',
        'latitude',
        'longitude',
        'ground_plan',
        'first_plan',
        'images',
        'community_ameities',
        'apartment_ameities',
        'apartment_type',
        'availability',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'images' => 'json',
    // ];

    protected $appends = ['ground_plan_url', 'first_plan_url'];

    public function getGroundPlanUrlAttribute()
    {
        return asset($this->ground_plan);
    }

    public function getFirstPlanUrlAttribute()
    {
        return asset($this->first_plan);
    }

    public function amenities()
    {
        return $this->hasMany(CoreAmenity::class);
    }

    public function thumbnail()
    {
        return $this->hasOne(PropertyFile::class)
            ->where('is_primary', true);
    }

    public function files()
    {
        return $this->hasMany(PropertyFile::class)->where('is_primary', false);
    }
}
