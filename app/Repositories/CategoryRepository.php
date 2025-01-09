<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface{
    public function getAllCategories(){
        return Category::get(['id', 'name', 'slug', 'image']);
    }

    public function getCategoryBySlug($slug){
        return Category::where('slug', $slug)->first();
    }
}