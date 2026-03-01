<div>
    {{-- Overlay backdrop --}}
    @if($showFromModal || $showToModal || $showPassengerModal || $showDateModal || $showReturnModal)
    <div class="fixed inset-0 bg-black/60 z-[9990]" wire:click="closeModals"></div>
    @endif

    {{-- Flight type tabs --}}
    <div class="flex justify-center mb-6">
        <div class="inline-flex p-1 bg-slate-200 dark:bg-slate-700 rounded-xl">
            <button wire:click="$set('tripType','roundtrip')"
                class="px-6 py-2 rounded-lg text-sm font-semibold transition {{ $tripType === 'roundtrip' ? 'bg-white dark:bg-slate-600 shadow-sm text-primary' : 'hover:bg-white/50' }}">
                ↔ Khứ hồi
            </button>
            <button wire:click="$set('tripType','oneway')"
                class="px-6 py-2 rounded-lg text-sm font-semibold transition {{ $tripType === 'oneway' ? 'bg-white dark:bg-slate-600 shadow-sm text-primary' : 'hover:bg-white/50' }}">
                → Một chiều
            </button>
        </div>
    </div>

    {{-- Main Search Form --}}
    <form action="{{ url('/schedule') }}" method="GET" class="w-full space-y-3">
        <input type="hidden" name="from" value="{{ $from }}">
        <input type="hidden" name="to" value="{{ $to }}">
        <input type="hidden" name="passengers" value="{{ $passengers }}">
        <input type="hidden" name="trip_type" value="{{ $tripType }}">

        {{-- Row 1: FROM | SWAP | TO --}}
        <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-end">
            {{-- FROM --}}
            <div class="flex-1 min-w-0">
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

            {{-- SWAP button (standalone, between FROM and TO) --}}
            <div class="flex-none flex justify-center sm:items-end">
                <button type="button" wire:click="swapLocations"
                    title="Đổi điểm đi/đến"
                    class="w-11 h-11 rounded-full bg-white dark:bg-slate-700 border-2 border-slate-300 dark:border-slate-600 flex items-center justify-center shadow hover:bg-primary hover:text-white hover:border-primary transition">
                    <span class="material-icons text-base">swap_horiz</span>
                </button>
            </div>

            {{-- TO --}}
            <div class="flex-1 min-w-0">
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
        </div>

        {{-- Row 2: Dates + Passengers --}}
        <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-end">
            {{-- Departure Date --}}
            <div class="flex-1 min-w-0 relative">
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Ngày đi</label>
                <button type="button" wire:click="openDateModal"
                    class="w-full flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700 hover:border-primary transition text-left">
                    <span class="material-icons text-slate-400 shrink-0">calendar_today</span>
                    <span class="text-sm text-slate-800 dark:text-white flex-1">
                        {{ $date ?: 'Chọn ngày đi' }}
                    </span>
                </button>
                <input type="hidden" name="date" value="{{ $date }}">
            </div>

            {{-- Departure calendar modal (fixed, centered) --}}
            @if($showDateModal)
            <div class="fixed inset-0 z-[9999] flex items-center justify-center px-4">
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-xs overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 dark:border-slate-700">
                        <button wire:click="prevCalendarMonth" type="button" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg">
                            <span class="material-icons text-base">chevron_left</span>
                        </button>
                        <span class="font-bold text-sm">Tháng {{ $calendarMonth }}/{{ $calendarYear }}</span>
                        <button wire:click="nextCalendarMonth" type="button" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg">
                            <span class="material-icons text-base">chevron_right</span>
                        </button>
                    </div>
                    <div class="p-3">
                        <div style="display:grid;grid-template-columns:repeat(7,minmax(0,1fr));" class="mb-1">
                            @foreach(['T2','T3','T4','T5','T6','T7','CN'] as $h)
                            <div class="text-center py-1" style="font-size:10px;font-weight:700;color:{{ $h==='CN' ? '#ef4444' : '#94a3b8' }}">{{ $h }}</div>
                            @endforeach
                        </div>
                        <div style="display:grid;grid-template-columns:repeat(7,minmax(0,1fr));gap:2px 0;">
                            @foreach($calendarDays as $cell)
                            @if($cell === null)
                            <div></div>
                            @else
                            <button
                                type="button"
                                wire:click="selectDate('{{ $cell['date'] }}')"
                                @if($cell['past']) disabled @endif
                                style="display:flex;flex-direction:column;align-items:center;padding:4px 2px;border-radius:8px;cursor:{{ $cell['past'] ? 'not-allowed' : 'pointer' }};opacity:{{ $cell['past'] ? '0.3' : '1' }};background:{{ $date===$cell['date'] ? '#2563eb' : 'transparent' }};color:{{ $date===$cell['date'] ? '#fff' : ($cell['dow']==0 ? '#ef4444' : 'inherit') }};"
                                class="hover:bg-blue-50 dark:hover:bg-slate-700 transition">
                                <span style="font-size:12px;font-weight:700;line-height:1;">{{ $cell['day'] }}</span>
                                @if($cell['price'])
                                <span style="font-size:9px;font-weight:600;line-height:1;margin-top:2px;color:{{ $date===$cell['date'] ? 'rgba(255,255,255,.85)' : '#2563eb' }}">
                                    {{ number_format($cell['price']/1000, 0) }}K
                                </span>
                                @endif
                            </button>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Return Date (roundtrip only) --}}
            @if($tripType === 'roundtrip')
            <div class="flex-1 min-w-0 relative">
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Ngày về</label>
                <button type="button" wire:click="openReturnModal"
                    class="w-full flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700 hover:border-primary transition text-left">
                    <span class="material-icons text-slate-400 shrink-0">event_available</span>
                    <span class="text-sm text-slate-800 dark:text-white flex-1">
                        {{ $returnDate ?: 'Chọn ngày về' }}
                    </span>
                </button>
                <input type="hidden" name="return_date" value="{{ $returnDate }}">
            </div>
            @endif

            {{-- Return calendar modal (fixed, centered) --}}
            @if($showReturnModal)
            <div class="fixed inset-0 z-[9999] flex items-center justify-center px-4">
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-xs overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 dark:border-slate-700">
                        <button wire:click="prevReturnMonth" type="button" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg">
                            <span class="material-icons text-base">chevron_left</span>
                        </button>
                        <span class="font-bold text-sm">Tháng {{ $returnCalendarMonth }}/{{ $returnCalendarYear }}</span>
                        <button wire:click="nextReturnMonth" type="button" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg">
                            <span class="material-icons text-base">chevron_right</span>
                        </button>
                    </div>
                    <div class="p-3">
                        <div style="display:grid;grid-template-columns:repeat(7,minmax(0,1fr));" class="mb-1">
                            @foreach(['T2','T3','T4','T5','T6','T7','CN'] as $h)
                            <div class="text-center py-1" style="font-size:10px;font-weight:700;color:{{ $h==='CN' ? '#ef4444' : '#94a3b8' }}">{{ $h }}</div>
                            @endforeach
                        </div>
                        <div style="display:grid;grid-template-columns:repeat(7,minmax(0,1fr));gap:2px 0;">
                            @foreach($returnDays as $cell)
                            @if($cell === null)
                            <div></div>
                            @else
                            <button
                                type="button"
                                wire:click="selectReturnDate('{{ $cell['date'] }}')"
                                @if($cell['past']) disabled @endif
                                style="display:flex;flex-direction:column;align-items:center;padding:4px 2px;border-radius:8px;cursor:{{ $cell['past'] ? 'not-allowed' : 'pointer' }};opacity:{{ $cell['past'] ? '0.3' : '1' }};background:{{ $returnDate===$cell['date'] ? '#2563eb' : 'transparent' }};color:{{ $returnDate===$cell['date'] ? '#fff' : ($cell['dow']==0 ? '#ef4444' : 'inherit') }};"
                                class="hover:bg-blue-50 dark:hover:bg-slate-700 transition">
                                <span style="font-size:12px;font-weight:700;line-height:1;">{{ $cell['day'] }}</span>
                                @if($cell['price'])
                                <span style="font-size:9px;font-weight:600;line-height:1;margin-top:2px;color:{{ $returnDate===$cell['date'] ? 'rgba(255,255,255,.85)' : '#2563eb' }}">
                                    {{ number_format($cell['price']/1000, 0) }}K
                                </span>
                                @endif
                            </button>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Passengers --}}
            <div class="flex-1 min-w-0">
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Hành khách & Hạng ghế</label>
                <button type="button" wire:click="togglePassengerModal"
                    class="w-full flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700 hover:border-primary transition text-left">
                    <span class="material-icons text-slate-400 shrink-0">group</span>
                    <span class="text-sm text-slate-700 dark:text-slate-200 truncate">{{ $passengers }}</span>
                </button>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg flex items-center justify-center space-x-2 transition-all transform hover:scale-[1.01] active:scale-95">
            <span class="material-icons">search</span>
            <span>Tìm kiếm chuyến bay</span>
        </button>
    </form>


    {{-- ======== FROM MODAL ======== --}}
    @if($showFromModal)
    <div class="fixed inset-0 z-[9999] flex items-start justify-center pt-4 px-3 overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[85vh] overflow-hidden flex flex-col my-4">
            <div class="flex items-center justify-between p-4 border-b border-slate-100 dark:border-slate-700 shrink-0">
                <h2 class="font-bold text-lg">Chọn điểm khởi hành</h2>
                <button wire:click="closeModals" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full">
                    <span class="material-icons">close</span>
                </button>
            </div>
            {{-- Search --}}
            <div class="p-3 border-b border-slate-100 dark:border-slate-700 shrink-0">
                <div class="flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl px-3 py-2 bg-slate-50 dark:bg-slate-700">
                    <span class="material-icons text-slate-400 text-lg">search</span>
                    <input wire:model.live.debounce.300ms="searchQuery"
                        class="flex-1 bg-transparent border-none focus:ring-0 p-0 text-sm placeholder-slate-400"
                        placeholder="Nhập tên thành phố hoặc mã sân bay"
                        type="text" />
                    @if($fromCode)
                    <span class="bg-primary text-white text-xs font-bold px-2 py-1 rounded-md shrink-0">{{ $fromCode }}</span>
                    @endif
                </div>
            </div>
            {{-- Content --}}
            <div class="overflow-y-auto flex-1">
                @if($filtered !== null)
                {{-- Search results --}}
                <div class="p-4 grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @forelse($filtered as $ap)
                    <button wire:click="selectFrom('{{ $ap->name }}','{{ $ap->code }}')"
                        class="w-full text-left py-2 px-3 rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 hover:border-primary hover:text-primary transition flex flex-col items-start gap-0.5 group">
                        <span class="text-xs font-bold leading-tight group-hover:text-primary transition">{{ $ap->name }}</span>
                        <div class="flex items-center gap-1 flex-wrap">
                            <span class="text-[10px] text-slate-400 font-medium bg-slate-100 dark:bg-slate-700 px-1.5 py-0.5 rounded">{{ $ap->code }}</span>
                            @if($ap->min_price)
                            <span class="text-[10px] text-green-600 font-bold">{{ number_format($ap->min_price, 0, ',', '.') }}đ</span>
                            @endif
                        </div>
                    </button>
                    @empty
                    <p class="col-span-3 text-slate-400 text-sm py-4 text-center">Không tìm thấy sân bay nào.</p>
                    @endforelse
                </div>
                @else
                {{-- Region Tabs --}}
                <div class="flex border-b border-slate-100 dark:border-slate-700 px-2 overflow-x-auto shrink-0">
                    @foreach($regions as $region)
                    <button wire:click="setFromTab('{{ $region->name }}')"
                        class="px-4 py-3 text-sm font-bold whitespace-nowrap border-b-2 transition
                            {{ $activeFromTab === $region->name ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                        {{ $region->name }}
                    </button>
                    @endforeach
                </div>
                {{-- Airport grid by sub-region --}}
                @foreach($regions as $region)
                @if($activeFromTab === $region->name)
                <div class="p-4 space-y-4">
                    @foreach($region->subRegions as $sub)
                    <div class="border border-slate-100 dark:border-slate-700 rounded-xl p-3 bg-slate-50/50 dark:bg-slate-700/50">
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-3">{{ $sub->name }}</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                            @foreach($sub->airports as $ap)
                            <button wire:click="selectFrom('{{ $ap->name }}','{{ $ap->code }}')"
                                class="w-full text-left py-2 px-3 rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 hover:border-primary hover:text-primary transition flex flex-col items-start gap-0.5 group">
                                <span class="text-xs font-bold leading-tight group-hover:text-primary transition">{{ $ap->name }}</span>
                                <div class="flex items-center gap-1 flex-wrap">
                                    <span class="text-[10px] text-slate-400 font-medium bg-slate-100 dark:bg-slate-700 px-1.5 py-0.5 rounded">{{ $ap->code }}</span>
                                    @if($ap->min_price)
                                    <span class="text-[10px] text-green-600 font-bold">{{ number_format($ap->min_price, 0, ',', '.') }}đ</span>
                                    @endif
                                </div>
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
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
    <div class="fixed inset-0 z-[9999] flex items-start justify-center pt-4 px-3 overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[85vh] overflow-hidden flex flex-col my-4">
            <div class="flex items-center justify-between p-4 border-b border-slate-100 dark:border-slate-700 shrink-0">
                <h2 class="font-bold text-lg">Chọn điểm đến</h2>
                <button wire:click="closeModals" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full">
                    <span class="material-icons">close</span>
                </button>
            </div>
            {{-- Search --}}
            <div class="p-3 border-b border-slate-100 dark:border-slate-700 shrink-0">
                <div class="flex items-center gap-2 border border-slate-300 dark:border-slate-600 rounded-xl px-3 py-2 bg-slate-50 dark:bg-slate-700">
                    <span class="material-icons text-slate-400 text-lg">search</span>
                    <input wire:model.live.debounce.300ms="searchQuery"
                        class="flex-1 bg-transparent border-none focus:ring-0 p-0 text-sm placeholder-slate-400"
                        placeholder="Nhập tên thành phố hoặc mã sân bay"
                        type="text" />
                    @if($toCode)
                    <span class="bg-primary text-white text-xs font-bold px-2 py-1 rounded-md shrink-0">{{ $toCode }}</span>
                    @endif
                </div>
            </div>
            {{-- Content --}}
            <div class="overflow-y-auto flex-1">
                @if($filtered !== null)
                <div class="p-4 grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @forelse($filtered as $ap)
                    <button wire:click="selectTo('{{ $ap->name }}','{{ $ap->code }}')"
                        class="w-full text-left py-2 px-3 rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 hover:border-primary hover:text-primary transition flex flex-col items-start gap-0.5 group">
                        <span class="text-xs font-bold leading-tight group-hover:text-primary transition">{{ $ap->name }}</span>
                        <div class="flex items-center gap-1 flex-wrap">
                            <span class="text-[10px] text-slate-400 font-medium bg-slate-100 dark:bg-slate-700 px-1.5 py-0.5 rounded">{{ $ap->code }}</span>
                            @if($ap->min_price)
                            <span class="text-[10px] text-green-600 font-bold">{{ number_format($ap->min_price, 0, ',', '.') }}đ</span>
                            @endif
                        </div>
                    </button>
                    @empty
                    <p class="col-span-3 text-slate-400 text-sm py-4 text-center">Không tìm thấy sân bay nào.</p>
                    @endforelse
                </div>
                @else
                <div class="flex border-b border-slate-100 dark:border-slate-700 px-2 overflow-x-auto shrink-0">
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
                <div class="p-4 space-y-4">
                    @foreach($region->subRegions as $sub)
                    <div class="border border-slate-100 dark:border-slate-700 rounded-xl p-3 bg-slate-50/50 dark:bg-slate-700/50">
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-3">{{ $sub->name }}</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                            @foreach($sub->airports as $ap)
                            <button wire:click="selectTo('{{ $ap->name }}','{{ $ap->code }}')"
                                class="w-full text-left py-2 px-3 rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 hover:border-primary hover:text-primary transition flex flex-col items-start gap-0.5 group">
                                <span class="text-xs font-bold leading-tight group-hover:text-primary transition">{{ $ap->name }}</span>
                                <div class="flex items-center gap-1 flex-wrap">
                                    <span class="text-[10px] text-slate-400 font-medium bg-slate-100 dark:bg-slate-700 px-1.5 py-0.5 rounded">{{ $ap->code }}</span>
                                    @if($ap->min_price)
                                    <span class="text-[10px] text-green-600 font-bold">{{ number_format($ap->min_price, 0, ',', '.') }}đ</span>
                                    @endif
                                </div>
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
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
    <div class="fixed inset-0 z-[9999] flex items-center justify-center px-4">
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