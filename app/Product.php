<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
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

    /**
     * Required by kyslik/column-sortable package
     *
     * Defines field that can be searched
     *
     * @var array
     */
    public $sortable = [
        'name',
        'price',
        'rating',
        'description'
    ];

    /**
     * Relationship to category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Accessor for constructing path to image
     *
     * @return string
     */
    public function getImagePathAttribute() {
        if(isset($this->image)) {
            return asset("storage/".$this->image);
        } else {
            return "";
        }
    }

    /**
     * Scope for searching name, description, and category.name columns by specified $filter
     *
     * @param $query
     * @param string $filter is phrase on which the search is based
     * @return mixed
     */
    public function scopeSearchByTerm($query, $filter) {
        $query->orWhere("name", "like", "%".$filter."%");
        $query->orWhere("description", "like", "%".$filter."%");

        $query->orWhereHas('category', function($query) use ($filter) {
            $query->where("name", "like", "%".$filter."%");
        });

        return $query;
    }

    /**
     * Scope for filtering by rating
     *
     * By receiving array parameter we can get multiple products with different ratings
     *
     * @param $query
     * @param array $filter numbers (1 - 5) which represents product rating
     * @return mixed
     */
    public function scopeFilterByRating($query, $filter) {
        if(isset($filter)) {
            return $query->whereIn('rating', array_values($filter));
        } else {
            return $query;
        }
    }

    /**
     * Scope for sorting category
     *
     * $sortBy determines if we really need to sort by category, and $direction determines direction of sorting
     *
     * @param Builder $query
     * @param string $sortBy sorting term
     * @param string $direction of sorting
     * @return mixed
     */
    public function scopeSortByCategory($query, $sortBy, $direction) {
        if(isset($sortBy) && isset($direction)
            && $sortBy == 'category' && in_array($direction, array('asc', 'desc'))) {
            return $query->select('products.*', \DB::raw('(select name from categories where products.category_id = categories.id) as category_name'))
                ->orderBy('category_name', $direction);
        }
        else return $query;
    }
}
