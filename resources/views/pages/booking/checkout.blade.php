@extends('layouts.app')
@section('content')
<div id="Background"
            class="absolute top-0 w-full h-[230px] rounded-b-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]">
        </div>
        <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
            <a href="{{ route('show-booking-information', ['slug' => $boardingHouse->slug]) }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white">
                <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" class="w-[28px] h-[28px]" alt="icon">
            </a>
            <p class="font-semibold">Pembayaran Kos</p>
            <div class="dummy-btn w-12"></div>
        </div>
        <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
            <div class="flex flex-col w-full rounded-[30px] border border-[#F1F2F6] p-4 gap-4 bg-white">
                <div class="flex gap-4">
                    <div class="flex w-[120px] h-[132px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ asset('storage/'. $boardingHouse->thumbnail) }}" class="w-full h-full object-cover" alt="icon">
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <p class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">{{ $boardingHouse->name }}</p>
                        <hr class="border-[#F1F2F6]">
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-5 h-5 flex shrink-0" alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $boardingHouse->city->name }}</p>
                        </div>
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex shrink-0" alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $boardingHouse->category->name }}</p>
                        </div>
                    </div>
                </div>
                <hr class="border-[#F1F2F6]">
                <div class="flex gap-4">
                    <div class="flex w-[120px] h-[156px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ asset('storage/'. $room->images->first()->image) }}" class="w-full h-full object-cover" alt="icon">
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <p class="font-semibold text-lg leading-[27px]">{{ $room->name }}</p>
                        <hr class="border-[#F1F2F6]">
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex shrink-0" alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $room->capacity }} orang/kamar</p>
                        </div>
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/3dcube.svg') }}" class="w-5 h-5 flex shrink-0" alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $room->square_feet }} m<sup>2</sup></p>
                        </div>
                        <hr class="border-[#F1F2F6]">
                        <p class="font-semibold text-lg text-ngekos-orange">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}<span
                                class="text-sm text-ngekos-grey font-normal">/bulan</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="accordion group flex flex-col rounded-[30px] p-5 bg-[#F5F6F8] mx-5 mt-5 overflow-hidden has-[:checked]:!h-[68px] transition-all duration-300">
            <label class="relative flex items-center justify-between">
                <p class="font-semibold text-lg">Pelanggan</p>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}"
                    class="w-[28px] h-[28px] flex shrink-0 group-has-[:checked]:rotate-180 transition-all duration-300"
                    alt="icon">
                <input type="checkbox" class="absolute hidden">
            </label>
            <div class="flex flex-col gap-4 pt-[22px]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Nama Lengkap</p>
                    </div>
                    <p class="font-semibold">{{ $transactionData["name"] }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Email</p>
                    </div>
                    <p class="font-semibold">{{ $transactionData["email"] }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Nomor Telepon</p>
                    </div>
                    <p class="font-semibold">{{ $transactionData["phone_number"] }}</p>
                </div>
            </div>
        </div>
        <div
            class="accordion group flex flex-col rounded-[30px] p-5 bg-[#F5F6F8] mx-5 mt-5 overflow-hidden has-[:checked]:!h-[68px] transition-all duration-300">
            <label class="relative flex items-center justify-between">
                <p class="font-semibold text-lg">Pemesanan</p>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}"
                    class="w-[28px] h-[28px] flex shrink-0 group-has-[:checked]:rotate-180 transition-all duration-300"
                    alt="icon">
                <input type="checkbox" class="absolute hidden">
            </label>
            <div class="flex flex-col gap-4 pt-[22px]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icons/clock.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Durasi</p>
                    </div>
                    <p class="font-semibold">{{ $transactionData["duration"] }} Bulan</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icons/calendar.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Dimulai pada</p>
                    </div>
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($transactionData["start_date"])->isoFormat("D MMMM YYYY") }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icons/calendar.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                        <p class="text-ngekos-grey">Berakhir pada</p>
                    </div>
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($transactionData["start_date"])->addMonths(intval($transactionData["duration"]))->isoFormat("D MMMM YYYY") }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('payment-process', ['slug' => $boardingHouse->slug]) }}" method="POST" class="relative flex flex-col gap-6 mt-5 pt-5">
            @csrf
            <input type="hidden" name="boarding_house_id" value="{{ $boardingHouse->id }}">
            <div id="PaymentOptions" class="flex flex-col rounded-[30px] border border-[#F1F2F6] p-5 gap-4 mx-5">
                @php
                    $subtotal = $room->price_per_month * $transactionData["duration"];
                    $tax = $subtotal * 0.12;
                    $insurance = $subtotal * 0.01;
                    $total = $subtotal + $tax + $insurance;
                    $downpayment = $total * 0.3;
                @endphp
                <div id="TabButton-Container"
                    class="flex items-center justify-between border-b border-[#F1F2F6] gap-[18px]">
                    <label class="tab-link group relative flex flex-col justify-between gap-4"
                        data-target-tab="#DownPayment-Tab">
                        <input type="radio" name="payment_method" value="down_payment"
                            class="absolute -z-10 top-1/2 left-1/2 opacity-0" checked>
                        <div class="flex items-center gap-3 mx-auto">
                            <div class="relative w-6 h-6">
                                <img src="{{ asset('assets/images/icons/status-orange.svg') }}"
                                    class="absolute w-6 h-6 flex shrink-0 opacity-0 group-has-[:checked]:opacity-100 transition-all duration-300"
                                    alt="icon">
                                <img src="{{ asset('assets/images/icons/status.svg') }}"
                                    class="absolute w-6 h-6 flex shrink-0 opacity-100 group-has-[:checked]:opacity-0 transition-all duration-300"
                                    alt="icon">
                            </div>
                            <p class="font-semibold">Bayar dimuka</p>
                        </div>
                        <div
                            class="w-0 mx-auto group-has-[:checked]:ring-1 group-has-[:checked]:ring-[#91BF77] group-has-[:checked]:w-[90%] transition-all duration-300">
                        </div>
                    </label>
                    <div class="flex h-6 w-[1px] border border-[#F1F2F6] mb-auto"></div>
                    <label class="tab-link group relative flex flex-col justify-between gap-4"
                        data-target-tab="#FullPayment-Tab">
                        <input type="radio" name="payment_method" value="full_payment"
                            class="absolute -z-10 top-1/2 left-1/2 opacity-0">
                        <div class="flex items-center gap-3 mx-auto">
                            <div class="relative w-6 h-6">
                                <img src="{{ asset('assets/images/icons/diamonds-orange.svg') }}"
                                    class="absolute w-6 h-6 flex shrink-0 opacity-0 group-has-[:checked]:opacity-100 transition-all duration-300"
                                    alt="icon">
                                <img src="{{ asset('assets/images/icons/diamonds.svg') }}"
                                    class="absolute w-6 h-6 flex shrink-0 group-has-[:checked]:opacity-0 transition-all duration-300"
                                    alt="icon">
                            </div>
                            <p class="font-semibold">Bayar lunas</p>
                        </div>
                        <div
                            class="w-0 mx-auto group-has-[:checked]:ring-1 group-has-[:checked]:ring-[#91BF77] group-has-[:checked]:w-[90%] transition-all duration-300">
                        </div>
                    </label>
                </div>
                <div id="TabContent-Container">
                    <div id="DownPayment-Tab" class="tab-content flex flex-col gap-4">
                        <p class="text-sm text-ngekos-grey">Anda perlu melunasi pembayaran secara cash setelah melakukan
                            survey kos</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/card-tick.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <p class="text-ngekos-grey">Payment</p>
                            </div>
                            <p class="font-semibold">Bayar dimuka 30%</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/receipt-2.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <p class="text-ngekos-grey">Sub Total</p>
                            </div>
                            <p class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/receipt-disscount.svg') }}" class="w-6 h-6 flex shrink-0"
                                    alt="icon">
                                <p class="text-ngekos-grey">PPN 12%</p>
                            </div>
                            <p class="font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/security-user.svg') }}" class="w-6 h-6 flex shrink-0"
                                    alt="icon">
                                <p class="text-ngekos-grey">Asuransi</p>
                            </div>
                            <p class="font-semibold">Rp {{ number_format($insurance, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/receipt-text.svg') }}" class="w-6 h-6 flex shrink-0"
                                    alt="icon">
                                <p class="text-ngekos-grey">Total pembayaran (30%)</p>
                            </div>
                            <p id="downPaymentPrice" class="font-semibold">Rp {{ number_format($downpayment, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div id="FullPayment-Tab" class="tab-content flex flex-col gap-4 hidden">
                        <p class="text-sm text-ngekos-grey">Anda tidak perlu membayar biaya tambahan apapun ketika
                            survey kos</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/card-tick.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <p class="text-ngekos-grey">Pembayaran</p>
                            </div>
                            <p class="font-semibold">Bayar lunas 100%</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/receipt-2.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <p class="text-ngekos-grey">Sub Total</p>
                            </div>
                            <p class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/receipt-disscount.svg') }}" class="w-6 h-6 flex shrink-0"
                                    alt="icon">
                                <p class="text-ngekos-grey">PPN 12%</p>
                            </div>
                            <p class="font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/security-user.svg') }}" class="w-6 h-6 flex shrink-0"
                                    alt="icon">
                                <p class="text-ngekos-grey">Asuransi</p>
                            </div>
                            <p class="font-semibold">Rp {{ number_format($insurance, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/images/icons/receipt-text.svg') }}" class="w-6 h-6 flex shrink-0"
                                    alt="icon">
                                <p class="text-ngekos-grey">Total pembayaran</p>
                            </div>
                            <p id="fullPaymentPrice" class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="BottomNav" class="relative flex w-full h-[132px] shrink-0">
                <div class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
                    <div class="flex items-center justify-between rounded-[40px] py-4 px-6 bg-ngekos-black">
                        <div class="flex flex-col gap-[2px]">
                            <p id="price" class="font-bold text-xl leading-[30px] text-white">
                                <!-- Price mengikuti pilihan yang dipilih dan diambil dari text grand total -->
                            </p>
                            <span class="text-sm text-white">Total pembayaran</span>
                        </div>
                        <button type="submit"
                            class="flex shrink-0 rounded-full py-[14px] px-5 bg-ngekos-orange font-bold text-white">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </form>

@push('scripts')
    <script src="{{ asset('assets/js/accodion.js') }}"></script>
    <script src="{{ asset('assets/js/checkout.js') }}"></script>
@endpush
@endsection
