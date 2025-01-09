@extends('layouts.app')
@section('content')
<div id="Background"
            class="absolute top-0 w-full h-[430px] rounded-b-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]">
        </div>
        <div class="relative flex flex-col gap-[30px] my-[60px] px-5">
            <h1 class="font-bold text-[30px] leading-[45px] text-center">Aduan Pengguna</h1>
            <form action="{{ route('customer-service-mail') }}" method="POST"
                class="flex flex-col rounded-[30px] border border-[#F1F2F6] p-5 gap-6 bg-white">
                @csrf
                @if(session('success'))
                <p class="text-center text-green-500">{{ session('success') }}</p>
                @endif
                <div id="InputContainer" class="flex flex-col gap-[18px]">
                    <div class="flex flex-col w-full gap-2">
                        <p class="font-semibold">Keluhan/Kritik</p>
                        <label
                            class="flex items-center w-full rounded-3xl p-[14px_20px] gap-3 bg-white ring-1 ring-[#F1F2F6] focus-within:ring-[#91BF77] transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/note-favorite-grey.svg') }}" class="w-5 h-5 flex shrink-0"
                                alt="icon">
                            <textarea name="message" id="message"
                                class="appearance-none outline-none w-full font-semibold placeholder:text-ngekos-grey placeholder:font-normal" autocomplete="off" rows="5"
                                placeholder="Sampaikan keluhan/kritik Anda terhadap aplikasi BookingKos ini"></textarea>
                        </label>
                        @error('message')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full gap-2">
                        <p class="font-semibold">Email</p>
                        <label
                            class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white ring-1 ring-[#F1F2F6] focus-within:ring-[#91BF77] transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-5 h-5 flex shrink-0" alt="icon">
                            <input type="email" name="email" id="email"
                                class="appearance-none outline-none w-full font-semibold placeholder:text-ngekos-grey placeholder:font-normal" autocomplete="off"
                                placeholder="Tulis email Anda" value="{{ old('email') }}">
                        </label>
                        @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <button type="submit"
                        class="flex w-full justify-center rounded-full p-[14px_20px] bg-ngekos-orange font-bold text-white">Kirim Aduan</button>
                </div>
            </form>
        </div>
@include('includes.navigation')
@endsection