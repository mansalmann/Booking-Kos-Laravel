@extends('layouts.app')
@section('content')
<div id="Background"
            class="absolute top-0 w-full h-[430px] rounded-b-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]">
        </div>
        <div class="relative flex flex-col gap-[30px] my-[60px] px-5">
            <h1 class="font-bold text-[30px] leading-[45px] text-center">Eksplorasi <br>Kos Terbaik untuk Anda</h1>
            <form action="{{ route('find-results-boarding-house') }}"
                class="flex flex-col rounded-[30px] border border-[#F1F2F6] p-5 gap-6 bg-white">
                <div id="InputContainer" class="flex flex-col gap-[18px]">
                    <div class="flex flex-col w-full gap-2">
                        <p class="font-semibold">Nama Kosan</p>
                        <label
                            class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white ring-1 ring-[#F1F2F6] focus-within:ring-[#91BF77] transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/note-favorite-grey.svg') }}" class="w-5 h-5 flex shrink-0"
                                alt="icon">
                            <input type="text" name="search" id="search"
                                class="appearance-none outline-none w-full font-semibold placeholder:text-ngekos-grey placeholder:font-normal" autocomplete="off"
                                placeholder="Cari kos-kosan...">
                        </label>
                    </div>
                    <div class="flex flex-col w-full gap-2">
                        <p class="font-semibold">Kota</p>
                        <label
                            class="relative flex items-center w-full rounded-full p-[14px_20px] gap-2 bg-white ring-1 ring-[#F1F2F6] focus-within:ring-[#91BF77] transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/location.svg') }}"
                                class="absolute w-5 h-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5"
                                alt="icon">
                            <select name="city" id="city" class="appearance-none outline-none w-full bg-white pl-8">
                                <option value="" hidden>Pilih salah satu kota</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->slug }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            <img src="{{ asset('assets/images/icons/arrow-down.svg') }}" class="w-5 h-5" alt="icon">
                        </label>
                    </div>
                    <div class="flex flex-col w-full gap-2">
                        <p class="font-semibold">Kategori</p>
                        <label
                            class="relative flex items-center w-full rounded-full p-[14px_20px] gap-2 bg-white ring-1 ring-[#F1F2F6] focus-within:ring-[#91BF77] transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/location.svg') }}"
                                class="absolute w-5 h-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5"
                                alt="icon">
                            <select name="category" id="category" class="appearance-none outline-none w-full bg-white pl-8">
                                <option value="" hidden>Pilih salah satu kategori</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <img src="{{ asset('assets/images/icons/arrow-down.svg') }}" class="w-5 h-5" alt="icon">
                        </label>
                    </div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-full p-[14px_20px] bg-ngekos-orange font-bold text-white">Cari sekarang</button>
                </div>
            </form>
        </div>
        @include('includes.navigation')
@endsection
