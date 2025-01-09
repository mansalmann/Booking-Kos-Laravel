<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\ShowBookingDetailsRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\BoardingHouseRepositoryInterface;

class BookingController extends Controller
{
    private BoardingHouseRepositoryInterface $boardingHouseRepository;
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(BoardingHouseRepositoryInterface $boardingHouseRepository, TransactionRepositoryInterface $transactionRepository)
    {
        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function checkBooking()
    {
        return response()->view('pages.booking.check-booking');
    }

    public function booking(Request $request, $slug)
    {
        $this->transactionRepository->saveTransactionDataToSession($request->only(['room_id']));
        return redirect()->route('show-booking-information', ['slug' => $slug]);
    }

    public function information($slug)
    {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $transactionData = $this->transactionRepository->getTransactionDataFromSession(); // array
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transactionData['room_id']);
        return response()->view('pages.booking.information', compact('boardingHouse', 'transactionData', 'room'));
    }

    public function save(BookingRequest $request, $slug)
    {
        $data = $request->validated();
        $this->transactionRepository->saveTransactionDataToSession($data);

        return redirect()->route('booking-checkout', ['slug' => $slug]);
    }

    public function checkout($slug)
    {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $transactionData = $this->transactionRepository->getTransactionDataFromSession(); // array
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById(id: $transactionData['room_id']);
        return response()->view('pages.booking.checkout', compact('boardingHouse', 'transactionData', 'room'));
    }

    public function payment(Request $request)
    {
        $this->transactionRepository->saveTransactionDataToSession($request->all());
        $transactionData = $this->transactionRepository->saveTransaction($this->transactionRepository->getTransactionDataFromSession());

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $params = array(
            'transaction_details' => array(
                'order_id' => $transactionData->code,
                'gross_amount' => $transactionData->total_amount,
            ),
            'customer_details' => array(
                'first_name' => $transactionData->name,
                'email' => $transactionData->email,
                'phone' => $transactionData->phone_number,
            ),
        );

        // generate payment url
        $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

        return redirect($paymentUrl);
    }

    public function transactionSuccess(Request $request)
    {
        $transaction = $this->transactionRepository->getTransactionByCode($request->get('order_id'));

        if(!$transaction){
            return redirect()->route('home');
        }
        return response()->view('pages.booking.transaction-success', compact('transaction'));
    }

    public function showBookingDetails(ShowBookingDetailsRequest $request){
        $transaction = $this->transactionRepository->getTransactionByCodeEmailPhone($request->code, $request->email, $request->phone_number);

        if(!$transaction){
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan');
        }

        return response()->view('pages.booking.details-booking', [
            'transaction' => $transaction
        ]);
    }
}
