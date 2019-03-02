<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Product;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function showProductsInCategory($id)
    {
        $category = self::find($id);
        if ($category){
            $products = $category::first()->products()->getResults();
            return $products;
        }
        else {
            throw new \Exception("There is no any category with id=$id found :(", 404);
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroyCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return $category;
        }
        throw new \Exception("There is no any category with id=$id found :(", 404);
    }
}
