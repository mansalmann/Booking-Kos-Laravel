<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getTransactionDataFromSession()
    {
        return session()->get('x-transaction-data');
    }

    public function saveTransactionDataToSession($data)
    {
        $transaction = session()->get('x-transaction-data', []);

        foreach($data as $key => $value){
            $transaction[$key] = $value;
        }

        // save the temporary transaction data to the session
        session()->put('x-transaction-data', $transaction);
    }

    public function saveTransaction($data){
        $room = Room::find($data['room_id']);

        $data = $this->prepareTransactionData($data, $room);
        $transaction = Transaction::create($data);

        session()->forget('x-transaction-data');
        return $transaction;
    }

    public function prepareTransactionData($data, $room){
        $data['code'] = $this->generateTransactionCode();
        $data['payment_status'] = 'pending';
        $data['transaction_date'] = now();

        $total = $this->calculateTotalAmount($room->price_per_month, $data['duration']);
        $data['total_amount'] = $this->calculatePaymentAmount($total, $data['payment_method']);
        return $data;
        
    }

    public function generateTransactionCode(){
        return "KOS" . rand(100000, 999999);
    }

    public function calculateTotalAmount($pricePerMonth, $duration){
        $subtotal = $pricePerMonth * $duration;
        $tax = $subtotal * 0.12;
        $insurance = $subtotal * 0.01;
        return $subtotal + $tax + $insurance;
    }

    public function calculatePaymentAmount($total, $paymentMethod){
        return $paymentMethod === 'full_payment' ? $total : $total * 0.3;
    }

    public function getTransactionByCode($code){
        return Transaction::where('code', $code)->first();
    }

    public function getTransactionByCodeEmailPhone($code, $email, $phone){
        return Transaction::where('code', $code)->where('email', $email)->where('phone_number', $phone)->first();
    }
}
