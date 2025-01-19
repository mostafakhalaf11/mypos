<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $fillable = ['image','purchase_price','sale_price', 'stock', 'category_id'];

    protected $gaurded = [];

    protected $translatedAttributes = ['name', 'description'];

    protected $ppend = ['image_path', 'profit_percent'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    }

    public function getProfitPercentAttribute()
    {
        $profit_percent = (($this->sale_price - $this->purchase_price) / $this->purchase_price) * 100;
        return number_format($profit_percent, 2);
    }

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }
}
