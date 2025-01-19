<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;


    public $translatedAttributes = ['name'];

    protected $fillable = ['code'];

    protected $gaurded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // public function getRouteKeyName()
    // {
    //     return 'code';
    // }

}
