<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Commentable;

class Product extends Model
{
    use Commentable;
    use Searchable;

    // Comment setting
    protected $mustBeApproved = true;
    protected $canBeRated = true;

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

    public function might_also_like($limit)
    {
        return $this->inRandomOrder()->take($limit);
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

}
