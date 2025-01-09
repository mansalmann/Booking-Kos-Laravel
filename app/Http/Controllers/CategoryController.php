<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private BoardingHouseRepositoryInterface $BoardingHouseRepository;
    private CategoryRepositoryInterface $CategoryRepository;

    public function __construct(CategoryRepositoryInterface $CategoryRepository, BoardingHouseRepositoryInterface $BoardingHouseRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
        $this->BoardingHouseRepository = $BoardingHouseRepository;
    }

    public function show($slug){
        $category = $this->CategoryRepository->getCategoryBySlug($slug);
        $boardingHouses = $this->BoardingHouseRepository->getBoardingHouseByCategorySlug($slug);
        return response()->view('pages.category.show', compact(['category', 'boardingHouses']));
    }

}
