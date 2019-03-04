<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Category;

class Product extends Model
{
    protected $fillable = ['name', 'color', 'amount', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        // Add unique filter
        return $this->belongsToMany('App\Models\Category');
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function showById($id)
    {
        // показ продукта по id
        $product = self::find($id);

        if ($product){
            $product->categories->toJson();
            return $product;
        }
        else {
            throw new \Exception("There is no any product with id=$id found :(", 404);
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function productDestroy($id)
    {
        // Удаление продукта
        $product = self::find($id);

        if ($product){
            $product->delete();
            return $product;
        }
        else {
            throw new \Exception("There is no any product with id=$id found :(", 404);
        }
    }

    /**
     * @param $id
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function productUpdate($id, $request)
    {
        // Обновить данные
        $product = self::find($id);
        if ($product){
            $product->update($request->all());
            return $product;
        }
        else {
            throw new \Exception("There is no any product with id=$id found :(", 404);
        }
    }

    /**
     * @param $id
     * @param $categoryId
     * @return mixed
     * @throws \Exception
     * Добавить категорию к продукту
     */
    public function addCategory($id, $categoryId)
    {
        $product = self::find($id);
        if (!$product){
            throw new \Exception("There is no any product with id=$id found :(", 404);
        }

        $category = Category::find($categoryId);
        if ($category){
            throw new \Exception("There is no any categories with $categoryId found :(", 404);
        }

        $product->categories()->sync($categoryId); // to avoid duplicates use sync
        return $product;
    }

    /**
     * @param $id
     * @param $categoryId
     * @return mixed
     * @throws \Exception
     */
    public function deleteCategory($id, $categoryId)
    {
        // Добавить категорию к продукту
        $product = self::find($id);
        if ($product){
            $product->categories()->detach($categoryId);
            return $product;
        }
        else {
            throw new \Exception("Product with id=$id is not found :(", 404);
        }
    }
}
