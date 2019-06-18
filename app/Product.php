<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'rating',
        'description',
        'image'
    ];

    public $sortable = [
        'name',
        'price',
        'rating',
        'description'
    ];


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
        if(isset($filter)) {
            return $query->whereIn('rating', array_values($filter));
        } else {
            return $query;
        }
    }

    public function scopeSortByCategory($query, $filter) {
        if(isset($filter['sort']) && isset($filter['direction'])
            && $filter['sort'] == 'category' && in_array($filter['direction'], array('asc', 'desc'))) {
            return $query->select('products.*', \DB::raw('(select name from categories where products.category_id = categories.id) as category_name'))
                ->orderBy('category_name', $filter['direction']);
        }
        else return $query;
    }
}
