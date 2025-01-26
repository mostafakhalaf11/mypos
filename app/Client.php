<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /////////use trait
    protected $fillable = ['name','phone', 'address'];

    protected $casts = [
        'phone' => 'array',
    ];

    protected $guarded = [];

    protected $appends = [];


}
