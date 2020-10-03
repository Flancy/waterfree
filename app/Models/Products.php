<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Products extends Model
{
    use Sluggable;

    protected $fillable = [
        'name', 'slug', 'description', 'logo', 'price', 'liter', 'hit', 'city_id', 'firm_id'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function cities()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }

    public function firms()
    {
        return $this->hasOne('App\Models\Firms', 'id', 'firm_id');
    }
    
    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }
}
