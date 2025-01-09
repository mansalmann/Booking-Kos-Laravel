<div id="BottomNav" class="relative flex w-full h-[138px] shrink-0">
    <nav class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
        <div class="grid grid-cols-4 h-fit rounded-[40px] justify-between py-4 px-5 bg-ngekos-black">
            <a href="{{ route('home') }}" wire:navigate class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('assets/images/icons/global' . (request()->routeIs('home') ? '-green' : '') . '.svg') }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <span class="font-semibold text-sm text-white">Jelajah</span>
            </a>
            <a href="{{ route('check-booking') }}" wire:navigate class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('assets/images/icons/note-favorite' . (request()->routeIs('check-booking') ? '-green' : '') . '.svg') }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <span class="font-semibold text-sm text-white">Pemesanan</span>
            </a>
            <a href="{{ route('find-boarding-house') }}" wire:navigate class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('assets/images/icons/search-status' . (request()->routeIs('find-boarding-house') ? '-green' : '') . '.svg') }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <span class="font-semibold text-sm text-white">Cari</span>
            </a>
            <a href="{{ route('customer-service') }}" class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('assets/images/icons/24-support.svg') }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <span class="font-semibold text-sm text-white">Aduan</span>
            </a>
        </div>
    </nav>
</div>