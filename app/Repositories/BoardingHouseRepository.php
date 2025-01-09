<?php

namespace App\Repositories;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\BoardingHouseRepositoryInterface;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface{
    public function getAllBoardingHouses(Request $request){
        $query = BoardingHouse::query();

        // search by keyword, city slug, and category slug

        if(trim($request->search)){
            $query->where('name', 'like','%' . $request->search . '%')->with(['city', 'category']);
        }

        if(trim($request->city)){
            $query->whereHas('city', function (Builder $query) use($request) {
                $query->where('slug', $request->city);
            });
        }

        if(trim($request->category)){
            $query->whereHas('category', function (Builder $query) use($request) {
                $query->where('slug', $request->category);
            });
        }

        return $query->get();
    }
    public function getPopularBoardingHouses($limit = 5){
        return BoardingHouse::with(['city', 'category'])->withCount('transactions')->orderBy('transactions_count', 'desc')->take($limit)->get();
    }
    public function getBoardingHouseByCitySlug($slug){
        return BoardingHouse::whereHas('city', function (Builder $query) use($slug) {
            $query->where('slug', $slug);
        })->get();
    }

    public function getBoardingHouseByCategorySlug($slug){
        return BoardingHouse::whereHas('category', function (Builder $query) use($slug) {
            $query->where('slug', $slug);
        })->get();
    }

    public function getBoardingHouseBySlug($slug){
        return BoardingHouse::where('slug', $slug)->first();
    }

    public function getBoardingHouseRoomById($id){
        return Room::find($id);
    }
}
