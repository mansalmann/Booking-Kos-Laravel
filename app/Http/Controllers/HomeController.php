<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CustomerServiceMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\CityRepositoryInterface;
use App\Http\Requests\CustomerServiceRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\BoardingHouseRepositoryInterface;

class HomeController extends Controller
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

    public function index(Request $request){
        $categories = $this->CategoryRepository->getAllCategories();
        $popularBoardingHouse = $this->BoardingHouseRepository->getPopularBoardingHouses();
        $cities = $this->CityRepository->getAllCities();
        $boardingHouses = $this->BoardingHouseRepository->getAllBoardingHouses($request);
        return response()->view('pages.home', compact(['categories', 'popularBoardingHouse', 'cities', 'boardingHouses']));
    }

    public function customerService(){
        return view('pages.customer-service.cs');
    }

    public function customerServiceMailProcess(CustomerServiceRequest $request){
        $data = $request->validated();
        $body = $data['message'];
        $email = $data['email'];
        Mail::to('work.salmann@gmail.com')->send(new CustomerServiceMail($body, $email));

        return redirect()->route('customer-service')->with('success', 'Aduan berhasil dikirim!');
    }
}
