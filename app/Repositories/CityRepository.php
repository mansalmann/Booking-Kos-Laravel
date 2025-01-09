<?php

namespace App\Repositories;

use App\Models\City;
use App\Interfaces\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface{
    public function getAllCities(){
        return City::get(['id', 'name', 'slug', 'image']);
    }

    public function getCityBySlug($slug){
        return City::where('slug', $slug)->first();
    }
}