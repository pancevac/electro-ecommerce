<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Commentable;
use TCG\Voyager\Traits\Translatable;

class Product extends Model
{
    use Commentable;
    //use Searchable;
    use Translatable;

    // Comment setting
    protected $mustBeApproved = true;
    protected $canBeRated = true;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * Translatable attributes
     *
     * @var array
     */
    protected $translatable = ['name', 'description', 'details'];

    // Fillable attributes


    // Queries
    public $where_name_category;
    public $where_category_value;
    public $where_name_manufacturer;
    public $where_manufacturer_value;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function manufacturer()
    {
        return $this->belongsTo('App\Models\Manufacturer');
    }

    public function gallery()
    {
        return $this->hasMany('App\Models\Gallery');
    }

    public function discount()
    {
        return $this->hasOne('App\Models\Discount');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')->withPivot('quantity', 'price', 'percent_off');
    }

    public function might_also_like($limit)
    {
        return $this->with(['category', 'discount', 'comments'])->inRandomOrder()->take($limit)->get();
    }

    /**
     * Get translatable attribute
     *
     * @param $attribute
     * @return null
     */
    public function get($attribute)
    {
        return $this->getTranslatedAttribute($attribute);
    }

    /**
     * Generate product url
     *
     * @return string
     */
    public function getUrl()
    {
        return route('product', ['product' => $this->id]);
    }

    public function store()
    {
        $record = \DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('manufacturers', 'products.manufacturer_id', '=', 'manufacturers.id')
            ->select('*');

        if ($this->where_name_category && $this->where_category_value) {

            $record->where($this->where_name_category , $this->where_category_value);
        }
        if ($this->where_name_manufacturer && $this->where_manufacturer_value) {

            $record->where($this->where_name_manufacturer, $this->where_manufacturer_value);
        }

        // return record
        return $record;
    }

    public function getAverageRate($products)
    {
        if ($products instanceof Collection) {

            foreach ($products as $product) {
                $product->averageProductRate = $product->comments->avg('rate');
            }
        }
        else {
            $products->averageProductRate = $products->comments->avg('rate');
        }

        return $products;
    }

    public function getRelatedProducts($product)
    {
        return $this->with(['category', 'comments', 'discount'])->whereHas('category', function($category) use ($product) {
            $category->where('id', $product->category->id);
        })
            ->where('id', '<>', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    public function getTotalComments($product)
    {
        $product->totalCommentsCount = $product->comments->count();
        return $product;
    }

}
