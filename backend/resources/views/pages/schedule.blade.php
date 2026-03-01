@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm chuyến bay')

@section('content')
<div class="container mx-auto px-6 py-8">
    {{-- Search Info Bar --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 mb-6 flex flex-col md:flex-row justify-between items-center border border-slate-200 dark:border-slate-700">
        <div>
            <h1 class="text-2xl font-bold flex items-center mb-2">
                <span>{{ $from }}</span>
                <span class="material-icons mx-3 text-slate-400">arrow_forward</span>
                <span>{{ $to }}</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 flex items-center text-sm">
                <span class="material-icons text-sm mr-1">calendar_today</span> {{ $date }} |
                <span class="material-icons text-sm ml-3 mr-1">group</span> {{ $passengers }}
            </p>
        </div>
        <a href="{{ url('/') }}" class="mt-4 md:mt-0 bg-primary/10 text-primary px-6 py-2 rounded-xl font-semibold hover:bg-primary/20 transition">
            <span class="material-icons text-sm align-middle mr-1">search</span> Tìm kiếm khác
        </a>
    </div>

    {{-- Date Tabs --}}
    <div class="flex overflow-x-auto space-x-2 mb-6 pb-2 scrollbar-hide">
        @foreach($dates as $i => $d)
        <a href="{{ url('/schedule') }}?from={{ urlencode($from) }}&to={{ urlencode($to) }}&date={{ urlencode($date) }}&passengers={{ urlencode($passengers) }}&selected_date={{ $d['value'] }}"
            class="flex-shrink-0 text-center px-5 py-3 rounded-xl border transition font-medium
           {{ $selectedDate === $d['value'] ? 'bg-primary text-white border-primary shadow-md' : 'bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 hover:border-primary' }}">
            <div class="text-xs {{ $selectedDate === $d['value'] ? 'text-blue-200' : 'text-slate-400' }}">{{ $d['dayName'] }}</div>
            <div class="text-lg font-bold">{{ $d['dayMonth'] }}</div>
        </a>
        @endforeach
    </div>

    {{-- Flights List --}}
    <div class="space-y-3">
        @forelse($flights as $flight)
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:border-primary transition group overflow-hidden">
            <div class="flex flex-col md:flex-row items-center p-5 gap-4">
                {{-- Airline --}}
                <div class="flex items-center space-x-3 w-full md:w-44 flex-shrink-0">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center font-bold text-primary text-sm">
                        {{ $flight->airline_code }}
                    </div>
                    <div>
                        <div class="font-bold text-sm">{{ $flight->airline_name }}</div>
                        <div class="text-xs text-slate-500">{{ $flight->flight_number }}</div>
                    </div>
                </div>

                {{-- Departure --}}
                <div class="text-center w-20 flex-shrink-0">
                    <div class="text-xl font-bold">{{ $flight->departure_time }}</div>
                    <div class="text-xs text-slate-500 font-semibold">{{ $flight->origin_code }}</div>
                </div>

                {{-- Duration --}}
                <div class="flex flex-col items-center flex-1 px-2 min-w-[120px]">
                    <div class="text-xs text-slate-400 mb-1">{{ $flight->duration_formatted }}</div>
                    <div class="w-full flex items-center">
                        <div class="h-px bg-slate-300 dark:bg-slate-600 flex-1"></div>
                        <span class="material-icons text-slate-300 dark:text-slate-600 mx-1 text-xs rotate-90">flight</span>
                        <div class="h-px bg-slate-300 dark:bg-slate-600 flex-1"></div>
                    </div>
                    <div class="text-xs text-slate-400 mt-1">{{ $flight->aircraft_type }}</div>
                </div>

                {{-- Arrival --}}
                <div class="text-center w-20 flex-shrink-0">
                    <div class="text-xl font-bold">{{ $flight->arrival_time }}</div>
                    <div class="text-xs text-slate-500 font-semibold">{{ $flight->destination_code }}</div>
                </div>

                {{-- Price & Action --}}
                <div class="flex items-center space-x-4 w-full md:w-auto mt-3 md:mt-0 pt-3 md:pt-0 border-t md:border-t-0 border-slate-100 dark:border-slate-700 justify-between md:justify-end">
                    <div class="text-right">
                        <div class="text-xl font-bold text-orange-500">{{ $flight->price_formatted }}</div>
                        <div class="text-xs text-slate-400">VNĐ/khách</div>
                    </div>
                    <button onclick="selectFlight({{ $flight->id }}, '{{ $flight->flight_number }}', '{{ $flight->airline_name }}', '{{ $flight->origin_code }}', '{{ $flight->destination_code }}', '{{ $flight->departure_time }}', '{{ $flight->arrival_time }}', {{ $flight->price }})"
                        class="bg-orange-500 text-white px-5 py-2.5 rounded-xl font-bold hover:bg-orange-600 transition transform group-hover:scale-105 shadow-md text-sm whitespace-nowrap">
                        Chọn vé
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-slate-800 p-12 rounded-2xl text-center border border-slate-200 dark:border-slate-700">
            <span class="material-icons text-5xl text-slate-300 mb-4">flight_takeoff</span>
            <p class="text-slate-500 text-lg">Không tìm thấy chuyến bay phù hợp cho ngày này.</p>
            <p class="text-slate-400 text-sm mt-2">Vui lòng chọn ngày khác hoặc thay đổi điểm đến.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Booking Modal --}}
<div id="booking-modal" class="fixed inset-0 z-[999] hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-slate-800 w-full max-w-lg rounded-3xl shadow-2xl p-8 relative">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <span class="material-icons">close</span>
            </button>
            <h2 class="text-2xl font-bold mb-2">Đặt vé máy bay</h2>
            <p class="text-slate-500 text-sm mb-6" id="modal-flight-info"></p>

            <form action="{{ url('/booking') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="flight_number" id="form-flight-number">
                <input type="hidden" name="airline_name" id="form-airline-name">
                <input type="hidden" name="origin" id="form-origin">
                <input type="hidden" name="destination" id="form-destination">
                <input type="hidden" name="departure_time" id="form-departure-time">
                <input type="hidden" name="arrival_time" id="form-arrival-time">
                <input type="hidden" name="price" id="form-price">
                <input type="hidden" name="flight_date" value="{{ $selectedDate }}">

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Họ và tên *</label>
                    <input type="text" name="customer_name" required class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 focus:border-primary focus:ring-primary" placeholder="Nguyễn Văn A">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Số điện thoại *</label>
                    <input type="tel" name="customer_phone" required class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 focus:border-primary focus:ring-primary" placeholder="0912 345 678">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <input type="email" name="customer_email" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 focus:border-primary focus:ring-primary" placeholder="email@example.com">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Số hành khách</label>
                    <select name="passengers" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 focus:border-primary focus:ring-primary">
                        <option value="1">1 hành khách</option>
                        <option value="2">2 hành khách</option>
                        <option value="3">3 hành khách</option>
                        <option value="4">4 hành khách</option>
                        <option value="5">5 hành khách</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Ghi chú</label>
                    <textarea name="customer_note" rows="2" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 focus:border-primary focus:ring-primary resize-none" placeholder="Yêu cầu đặc biệt..."></textarea>
                </div>
                <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-xl flex justify-between items-center">
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Tổng tiền:</span>
                    <span class="text-2xl font-bold text-orange-500" id="modal-total-price"></span>
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:scale-[1.01]">
                    <span class="material-icons text-sm align-middle mr-1">check_circle</span> Xác nhận đặt vé
                </button>
            </form>
        </div>
    </div>
</div>

@if(session('booking_success'))
<div id="success-toast" class="fixed top-20 right-6 z-[9999] bg-green-500 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center space-x-3 animate-bounce">
    <span class="material-icons">check_circle</span>
    <div>
        <div class="font-bold">Đặt vé thành công!</div>
        <div class="text-sm">Mã đặt vé: {{ session('booking_code') }}</div>
    </div>
    <button onclick="document.getElementById('success-toast').remove()" class="ml-4"><span class="material-icons text-sm">close</span></button>
</div>
<script>
    setTimeout(() => {
        const t = document.getElementById('success-toast');
        if (t) t.remove();
    }, 5000);
</script>
@endif
@endsection

@push('scripts')
<script>
    function selectFlight(id, flightNumber, airline, origin, dest, depTime, arrTime, price) {
        // Store in session via hidden fields
        document.getElementById('form-flight-number').value = flightNumber;
        document.getElementById('form-airline-name').value = airline;
        document.getElementById('form-origin').value = origin;
        document.getElementById('form-destination').value = dest;
        document.getElementById('form-departure-time').value = depTime;
        document.getElementById('form-arrival-time').value = arrTime;
        document.getElementById('form-price').value = price;

        // Update modal display
        document.getElementById('modal-flight-info').textContent =
            `${airline} - ${flightNumber} | ${origin} → ${dest} | ${depTime} - ${arrTime}`;
        document.getElementById('modal-total-price').textContent =
            new Intl.NumberFormat('vi-VN').format(price) + 'đ';

        // Show modal
        document.getElementById('booking-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('booking-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }
</script>
@endpush