<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name', 'description', 'owner_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
