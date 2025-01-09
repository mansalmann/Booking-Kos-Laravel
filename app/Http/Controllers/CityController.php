<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;

class CityController extends Controller
{
    private BoardingHouseRepositoryInterface $BoardingHouseRepository;
    private CityRepositoryInterface $CityRepository;

    public function __construct(CityRepositoryInterface $CityRepository, BoardingHouseRepositoryInterface $BoardingHouseRepository)
    {
        $this->CityRepository = $CityRepository;
        $this->BoardingHouseRepository = $BoardingHouseRepository;
    }

    public function show($slug){
        $city = $this->CityRepository->getCityBySlug($slug);
        $boardingHouses = $this->BoardingHouseRepository->getBoardingHouseByCitySlug($slug);
        return response()->view('pages.city.show', compact(['city', 'boardingHouses']));
    }

}