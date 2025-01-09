<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface BoardingHouseRepositoryInterface{
    public function getAllBoardingHouses(Request $request);
    public function getPopularBoardingHouses($limit = 5);
    public function getBoardingHouseByCitySlug($slug);
    public function getBoardingHouseByCategorySlug($slug);
    public function getBoardingHouseBySlug($slug);
    public function getBoardingHouseRoomById($id);
}
