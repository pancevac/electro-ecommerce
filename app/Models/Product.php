<?php

namespace App\Models;

use App\Traits\HasBuyable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Commentable;
use TCG\Voyager\Traits\Translatable;

class Product extends Model implements Buyable
{
    use Commentable;
    //use Searchable;
    use Translatable;
    use HasBuyable;

    // Comment setting
    protected $mustBeApproved = true;
    protected $canBeRated = true;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    //protected $with = ['translations'];

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

    public function mightAlsoLike($limit)
    {
        return $this->with(['translations', 'category', 'manufacturer', 'discount', 'comments'])
            ->inRandomOrder()->take($limit)->get();
    }

    /**
     * Get translatable attribute
     *
     * @param $attribute
     * @param null $locale
     * @return string
     */
    public function get($attribute, $locale = null)
    {
        return $this->getTranslatedAttribute($attribute, $locale);
    }

    /**
     * Generate product url
     *
     * @param null $locale
     * @return string
     */
    public function getUrl($locale = null)
    {
        return getLocalizedRoute(
            'routes.product',
            [
                'category' => $this->category->slug,
                'manufacturer' => $this->manufacturer->slug,
                'product' => $this->get('slug', $locale),
                'code' => $this->code,
            ],
            $locale
        );
    }

    /**
     * Return link flag
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return $this->getUrl();
    }

    /**
     * Get image for vue.
     *
     * @return string
     */
    public function getImageVueAttribute()
    {
        return productImage($this->image);
    }

    /**
     * Get optimized product thumbnail image.
     *
     * @return string
     */
    public function getThumbImageAttribute()
    {
        return \Imagecache::get($this->image, 'product_thumb')->src;
    }

    /**
     * Get optimized small product image.
     *
     * @return string
     */
    public function getSmallImageAttribute()
    {
        return \Imagecache::get($this->image, 'product_small')->src;
    }

    /**
     * Get optimized email product image.
     *
     * @return string
     */
    public function getEmailImageAttribute()
    {
        return \Imagecache::get($this->image, 'product_email')->src;
    }

    /**
     * Returns discounted price if there is discount, otherwise, return original price
     *
     * @return float
     */
    public function getDiscountedPriceAttribute()
    {
        return $this->hasDiscount() ?
            $this->price - (($this->discount->percent_off / 100) * $this->price) :
            $this->price;
    }

    /**
     * Get product total comments count flag
     *
     * @return int
     */
    public function getTotalCommentCountAttribute()
    {
        return ($this->mustBeApproved()) ?
            $this->comments->where('approved', true)->count() :
            $this->comments->count();
    }

    /**
     * Get product average rate flag
     *
     * @return float|int
     */
    public function getAverageRateAttribute()
    {
        return ($this->getCanBeRated()) ?
            $this->comments->where('approved', true)->avg('rate') :
            0;
    }

    /**
     * Return true if product has discount
     *
     * @return bool
     */
    public function hasDiscount()
    {
        if (! $this->relationLoaded('discount')) {
            $this->load('discount');
        }

        return isset($this->discount->percent_off) && $this->discount->percent_off ? true : false;
    }

    /**
     * Return true if product is in stock
     *
     * @return bool
     */
    public function isInStock()
    {
        return $this->stock;
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

    public function getRelatedProducts()
    {
        return $this->with(['translations', 'category', 'comments', 'manufacturer', 'discount'])
            ->whereHas('category', function($category) {
                $category->where('id', $this->category->id);
            })
            ->where('id', '<>', $this->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

}
