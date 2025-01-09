<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\BoardingHouseRepositoryInterface;


class BoardingHouseController extends Controller
{
    private CityRepositoryInterface $CityRepository;
    private CategoryRepositoryInterface $CategoryRepository;
    private BoardingHouseRepositoryInterface $BoardingHouseRepository;

    public function __construct(CityRepositoryInterface $CityRepository, CategoryRepositoryInterface $CategoryRepository, BoardingHouseRepositoryInterface $BoardingHouseRepository)
    {
        $this->CityRepository = $CityRepository;
        $this->CategoryRepository = $CategoryRepository;
        $this->BoardingHouseRepository = $BoardingHouseRepository;
    }

    public function show($slug){
        $boardingHouse = $this->BoardingHouseRepository->getBoardingHouseBySlug($slug);
        return response()->view('pages.boarding-house.show', compact(['boardingHouse']));
    }

    public function boardingHouses(Request $request){
        $boardingHouses = $this->BoardingHouseRepository->getAllBoardingHouses($request);

        return response()->view('pages.boarding-house.boarding-houses-list', ['boardingHouses' => $boardingHouses]);
    }
    public function rooms($slug){
        $boardingHouse = $this->BoardingHouseRepository->getBoardingHouseBySlug($slug);
        return response()->view('pages.boarding-house.rooms', compact(['boardingHouse']));
    }

    public function find(){
        $categories = $this->CategoryRepository->getAllCategories();
        $cities = $this->CityRepository->getAllCities();
        return response()->view('pages.boarding-house.find', compact(['categories', 'cities']));
    }

    public function findResults(Request $request){
        $boardingHouses = $this->BoardingHouseRepository->getAllBoardingHouses($request);
        return response()->view('pages.boarding-house.find-results', compact(['boardingHouses']));
    }

}
