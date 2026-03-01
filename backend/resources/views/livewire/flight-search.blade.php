<div>
    {{-- Overlay backdrop --}}
    @if($showFromModal || $showToModal || $showPassengerModal)
    <div class="fixed inset-0 bg-black/40 z-40" wire:click="closeModals"></div>
    @endif

    {{-- Flight type tabs --}}
    <div class="flex justify-center mb-6">
        <div class="inline-flex p-1 bg-slate-200 dark:bg-slate-700 rounded-xl">
            <button wire:click="$set('tripType','roundtrip')"
                class="px-6 py-2 rounded-lg text-sm font-semibold transition {{ $tripType === 'roundtrip' ? 'bg-white dark:bg-slate-600 shadow-sm' : 'hover:bg-white/50' }}">
                Khứ hồi
            </button>
            <button wire:click="$set('tripType','oneway')"
                class="px-6 py-2 rounded-lg text-sm font-semibold transition {{ $tripType === 'oneway' ? 'bg-white dark:bg-slate-600 shadow-sm' : 'hover:bg-white/50' }}">
                Một chiều
            </button>
        </div>
    </div>

    {{-- Main Search Form --}}
    <form action="{{ url('/schedule') }}" method="GET" class="w-full">
        <input type="hidden" name="from" value="{{ $from }}">
        <input type="hidden" name="to" value="{{ $to }}">
        <input type="hidden" name="passengers" value="{{ $passengers }}">
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 items-end">
            {{-- FROM --}}
            <div class="relative">
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Điểm khởi hành</label>
                <button type="button" wire:click="openFromModal"
                    class="w-full flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700 hover:border-primary transition text-left">
                    <span class="material-icons text-slate-400 shrink-0">flight_takeoff</span>
                    <div class="flex-1 min-w-0">
                        <div class="font-bold text-slate-800 dark:text-white truncate text-sm">{{ $fromName }}</div>
                        <div class="text-xs text-slate-400">{{ $fromCode }}</div>
                    </div>
                </button>
            </div>

            {{-- SWAP button --}}
            <div class="relative hidden lg:block md:block">
                <label class="block text-xs font-bold text-transparent mb-1">Đổi</label>
                <div class="relative">
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Điểm đến</label>
                    <button type="button" wire:click="openToModal"
                        class="w-full flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700 hover:border-primary transition text-left">
                        <span class="material-icons text-slate-400 shrink-0">flight_land</span>
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-slate-800 dark:text-white truncate text-sm">{{ $toName }}</div>
                            <div class="text-xs text-slate-400">{{ $toCode }}</div>
                        </div>
                    </button>
                    {{-- Swap icon between from/to --}}
                    <button type="button" wire:click="swapLocations"
                        class="absolute -left-5 top-1/2 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white dark:bg-slate-700 border-2 border-slate-200 dark:border-slate-600 flex items-center justify-center shadow-md hover:bg-primary hover:text-white hover:border-primary transition z-10">
                        <span class="material-icons text-sm">swap_horiz</span>
                    </button>
                </div>
            </div>

            {{-- DATE --}}
            <div class="relative">
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">
                    {{ $tripType === 'roundtrip' ? 'Ngày đi - Ngày về' : 'Ngày đi' }}
                </label>
                <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                    <span class="material-icons text-slate-400 mr-2 shrink-0">calendar_today</span>
                    <input name="date" wire:model="date" class="bg-transparent border-none focus:ring-0 w-full p-0 text-sm" placeholder="dd/mm/yyyy" type="text" />
                </div>
            </div>

            {{-- PASSENGERS --}}
            <div class="relative">
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Hành khách & Hạng ghế</label>
                <button type="button" wire:click="togglePassengerModal"
                    class="w-full flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700 hover:border-primary transition text-left">
                    <span class="material-icons text-slate-400 shrink-0">group</span>
                    <span class="text-sm text-slate-700 dark:text-slate-200 truncate">{{ $passengers }}</span>
                </button>
            </div>
        </div>

        {{-- Mobile TO field --}}
        <div class="md:hidden mb-3">
            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Điểm đến</label>
            <button type="button" wire:click="openToModal"
                class="w-full flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700 hover:border-primary transition text-left">
                <span class="material-icons text-slate-400 shrink-0">flight_land</span>
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-slate-800 dark:text-white truncate text-sm">{{ $toName }}</div>
                    <div class="text-xs text-slate-400">{{ $toCode }}</div>
                </div>
            </button>
        </div>

        <button type="submit"
            class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg flex items-center justify-center space-x-2 transition-all transform hover:scale-[1.01] active:scale-95">
            <span class="material-icons">search</span>
            <span>Tìm kiếm chuyến bay</span>
        </button>
    </form>

    {{-- ======== FROM MODAL ======== --}}
    @if($showFromModal)
    <div class="fixed inset-0 z-50 flex items-start justify-center pt-6 px-4"
        x-data x-init="$el.querySelector('input')?.focus()">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[80vh] overflow-hidden flex flex-col">
            <div class="flex items-center justify-between p-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-bold text-lg">Chọn thành phố / sân bay</h2>
                <button wire:click="closeModals" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full">
                    <span class="material-icons">close</span>
                </button>
            </div>
            {{-- Search field with current selection badge --}}
            <div class="p-4 border-b border-slate-100 dark:border-slate-700">
                <p class="text-xs font-bold text-slate-500 uppercase mb-2">Từ</p>
                <div class="flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl px-3 py-2 bg-slate-50 dark:bg-slate-700">
                    <span class="material-icons text-slate-400 text-lg">search</span>
                    <input wire:model.live.debounce.300ms="searchQuery"
                        class="flex-1 bg-transparent border-none focus:ring-0 p-0 text-sm placeholder-slate-400"
                        placeholder="Nhập tên thành phố hoặc mã sân bay"
                        type="text" />
                    <span class="bg-primary text-white text-xs font-bold px-2 py-1 rounded-md shrink-0">{{ $fromCode }}</span>
                </div>
            </div>
            {{-- Content --}}
            <div class="overflow-y-auto flex-1">
                @if($filtered !== null)
                {{-- Search results --}}
                <div class="p-4 grid grid-cols-2 gap-2">
                    @forelse($filtered as $ap)
                    <button wire:click="selectFrom('{{ $ap->name }}','{{ $ap->code }}')"
                        class="text-left px-3 py-2 rounded-lg hover:bg-blue-50 dark:hover:bg-slate-700 text-sm text-slate-700 dark:text-slate-300 flex justify-between items-center group">
                        <span>{{ $ap->name }}</span>
                        <span class="text-xs font-bold text-primary opacity-0 group-hover:opacity-100">{{ $ap->code }}</span>
                    </button>
                    @empty
                    <p class="col-span-2 text-slate-400 text-sm py-4 text-center">Không tìm thấy sân bay nào.</p>
                    @endforelse
                </div>
                @else
                {{-- Tabs --}}
                <div class="flex border-b border-slate-100 dark:border-slate-700 px-2 overflow-x-auto">
                    @foreach($regions as $region)
                    <button wire:click="setFromTab('{{ $region->name }}')"
                        class="px-4 py-3 text-sm font-bold whitespace-nowrap border-b-2 transition
                            {{ $activeFromTab === $region->name ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                        {{ $region->name }}
                    </button>
                    @endforeach
                </div>
                {{-- Airports by sub-region --}}
                @foreach($regions as $region)
                @if($activeFromTab === $region->name)
                <div class="p-4" x-data="{ openRegions: [] }">
                    <div class="space-y-4">
                        @foreach($region->subRegions as $sub)
                        <div class="border border-slate-100 dark:border-slate-700 rounded-xl p-3 bg-slate-50/50 dark:bg-slate-700/50">
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-3">{{ $sub->name }}</p>
                            <div class="grid grid-cols-2 shadow-sm sm:grid-cols-3 gap-2">
                                @foreach($sub->airports as $ap)
                                <button wire:click="selectFrom('{{ $ap->name }}','{{ $ap->code }}')"
                                    class="w-full text-left py-2 px-3 rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 hover:border-primary hover:text-primary transition flex flex-col items-start gap-0.5 group">
                                    <span class="text-xs font-bold leading-tight group-hover:text-primary transition">{{ $ap->name }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium bg-slate-100 dark:bg-slate-700 px-1.5 py-0.5 rounded">{{ $ap->code }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- ======== TO MODAL ======== --}}
    @if($showToModal)
    <div class="fixed inset-0 z-50 flex items-start justify-center pt-6 px-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[80vh] overflow-hidden flex flex-col">
            <div class="flex items-center justify-between p-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-bold text-lg">Chọn sân bay đến</h2>
                <button wire:click="closeModals" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1 px-3 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                    <span class="material-icons text-base">close</span> Đóng
                </button>
            </div>
            <div class="p-4 border-b border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl px-3 py-2 bg-slate-50 dark:bg-slate-700">
                    <span class="material-icons text-slate-400 text-lg">search</span>
                    <input wire:model.live.debounce.300ms="searchQuery"
                        class="flex-1 bg-transparent border-none focus:ring-0 p-0 text-sm placeholder-slate-400"
                        placeholder="Nhập tên thành phố hoặc mã sân bay"
                        type="text" />
                    <button class="bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-md shrink-0">Chọn</button>
                </div>
            </div>
            <div class="overflow-y-auto flex-1">
                @if($filtered !== null)
                <div class="p-4 grid grid-cols-2 gap-2">
                    @forelse($filtered as $ap)
                    <button wire:click="selectTo('{{ $ap->name }}','{{ $ap->code }}')"
                        class="text-left px-3 py-2 rounded-lg hover:bg-blue-50 dark:hover:bg-slate-700 text-sm text-slate-700 dark:text-slate-300 flex justify-between items-center group">
                        <span>{{ $ap->name }}</span>
                        <span class="text-xs font-bold text-primary opacity-0 group-hover:opacity-100">{{ $ap->code }}</span>
                    </button>
                    @empty
                    <p class="col-span-2 text-slate-400 text-sm py-4 text-center">Không tìm thấy sân bay nào.</p>
                    @endforelse
                </div>
                @else
                <div class="flex border-b border-slate-100 dark:border-slate-700 px-2 overflow-x-auto">
                    @foreach($regions as $region)
                    <button wire:click="setToTab('{{ $region->name }}')"
                        class="px-4 py-3 text-sm font-bold whitespace-nowrap border-b-2 transition
                            {{ $activeToTab === $region->name ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                        {{ $region->name }}
                    </button>
                    @endforeach
                </div>
                @foreach($regions as $region)
                @if($activeToTab === $region->name)
                <div class="p-4">
                    <div class="space-y-4">
                        @foreach($region->subRegions as $sub)
                        <div class="border border-slate-100 dark:border-slate-700 rounded-xl p-3 bg-slate-50/50 dark:bg-slate-700/50">
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-3">{{ $sub->name }}</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                @foreach($sub->airports as $ap)
                                <button wire:click="selectTo('{{ $ap->name }}','{{ $ap->code }}')"
                                    class="w-full text-left py-2 px-3 rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 hover:border-primary hover:text-primary transition flex flex-col items-start gap-0.5 group">
                                    <span class="text-xs font-bold leading-tight group-hover:text-primary transition">{{ $ap->name }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium bg-slate-100 dark:bg-slate-700 px-1.5 py-0.5 rounded">{{ $ap->code }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- ======== PASSENGER MODAL ======== --}}
    @if($showPassengerModal)
    <div class="fixed inset-0 z-50 flex items-start justify-center pt-6 px-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-bold text-lg">Hành khách & Hạng ghế</h2>
                <button wire:click="closeModals" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <div class="p-5 space-y-4">
                {{-- Adults --}}
                <div class="flex justify-between items-center">
                    <div>
                        <div class="font-semibold text-sm">Người lớn</div>
                        <div class="text-xs text-slate-400">Từ 12 tuổi trở lên</div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button wire:click="decrementAdults" type="button"
                            class="w-8 h-8 rounded-full border-2 border-slate-300 flex items-center justify-center hover:border-primary hover:text-primary transition font-bold">−</button>
                        <span class="w-5 text-center font-bold">{{ $adults }}</span>
                        <button wire:click="incrementAdults" type="button"
                            class="w-8 h-8 rounded-full border-2 border-slate-300 flex items-center justify-center hover:border-primary hover:text-primary transition font-bold">+</button>
                    </div>
                </div>
                {{-- Children --}}
                <div class="flex justify-between items-center">
                    <div>
                        <div class="font-semibold text-sm">Trẻ em</div>
                        <div class="text-xs text-slate-400">Từ 2 - 11 tuổi</div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button wire:click="decrementChildren" type="button"
                            class="w-8 h-8 rounded-full border-2 border-slate-300 flex items-center justify-center hover:border-primary hover:text-primary transition font-bold">−</button>
                        <span class="w-5 text-center font-bold">{{ $children }}</span>
                        <button wire:click="incrementChildren" type="button"
                            class="w-8 h-8 rounded-full border-2 border-slate-300 flex items-center justify-center hover:border-primary hover:text-primary transition font-bold">+</button>
                    </div>
                </div>
                {{-- Infants --}}
                <div class="flex justify-between items-center">
                    <div>
                        <div class="font-semibold text-sm">Em bé</div>
                        <div class="text-xs text-slate-400">Dưới 2 tuổi</div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button wire:click="decrementInfants" type="button"
                            class="w-8 h-8 rounded-full border-2 border-slate-300 flex items-center justify-center hover:border-primary hover:text-primary transition font-bold">−</button>
                        <span class="w-5 text-center font-bold">{{ $infants }}</span>
                        <button wire:click="incrementInfants" type="button"
                            class="w-8 h-8 rounded-full border-2 border-slate-300 flex items-center justify-center hover:border-primary hover:text-primary transition font-bold">+</button>
                    </div>
                </div>
                {{-- Seat class --}}
                <div class="border-t border-slate-100 dark:border-slate-700 pt-4">
                    <p class="text-xs font-bold text-slate-500 uppercase mb-2">Hạng ghế</p>
                    <div class="flex gap-2 flex-wrap">
                        @foreach(['Phổ thông', 'Phổ thông đặc biệt', 'Thương gia', 'Hạng nhất'] as $cls)
                        <button wire:click="$set('seatClass', '{{ $cls }}')" type="button"
                            class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition
                            {{ $seatClass === $cls ? 'border-primary bg-primary text-white' : 'border-slate-200 text-slate-600 hover:border-primary hover:text-primary' }}">
                            {{ $cls }}
                        </button>
                        @endforeach
                    </div>
                </div>
                <button wire:click="updatePassengers" type="button"
                    class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
    @endif
</div>