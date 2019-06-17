<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'rating',
        'description',
        'image'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearchByTerm($query, $filter) {
        $query->orWhere("name", "like", "%".$filter."%");
        $query->orWhere("description", "like", "%".$filter."%");

        $query->orWhereHas('category', function($query) use ($filter) {
            $query->where("name", "like", "%".$filter."%");
        });

        return $query;
    }

    public function scopeFilterByRating($query, $filter) {
        if($filter != null) {
            $query->whereIn('rating', array_values($filter));
        }
    }
}
