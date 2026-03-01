@extends('layouts.app')

@section('title', 'Tìm kiếm vé máy bay giá rẻ')
@section('meta_description', 'Đặt vé máy bay giá rẻ tất cả hãng bay - Vietnam Airlines, Vietjet Air, Bamboo Airways. So sánh giá và đặt vé nhanh nhất tại giabaotravel.')
@section('meta_keywords', 'vé máy bay giá rẻ, đặt vé máy bay, Vietnam Airlines, Vietjet Air, Bamboo Airways, giabaotravel')

@section('content')

<section class="relative h-auto min-h-[420px] w-full flex items-center justify-center py-12">
    <img alt="Máy bay trên bầu trời xanh" class="absolute inset-0 w-full h-full object-cover brightness-75"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOUNqqqV_GMB7B85V3pW52tXW9MYMC-Y3rAm4KsxO72imzty5ThzU1oHd7-Y4VH41km7JLYWPHatLT3f8I34fdPfsiQ290GqgWEGIS-Sn0MtsdjxmqbjkfYwnGm5GfAY9UZtGkUm8dAgNgZUwAFj6NyWoUTEX6DExwtTyzXelPPizXZPIpc-GzKeyTUcmTwDTPsa6Tb8mfeBj24AxEgzIqUmw-SVTesqUcbutycPfAZEQEQg2GYrp2UML_rg6q78NsMoD8B1M1pD4" />
    <div class="absolute inset-0 bg-gradient-to-b from-primary/30 to-transparent"></div>
    <div class="relative z-10 w-full max-w-5xl px-6">
        <div class="bg-white dark:bg-slate-800 p-6 md:p-8 md:my-0 my-3 rounded-2xl shadow-2xl border border-white/20">
            <livewire:flight-search />
        </div>
    </div>
</section>
<div class="container mx-auto px-6 py-16 space-y-20">
    <section>
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold">Vé giá tốt</h2>
                <p class="text-slate-500 dark:text-slate-400">Những vé máy bay giá tốt nhất từ cơ sở dữ liệu của chúng tôi</p>
            </div>
            <a class="text-primary font-semibold flex items-center hover:underline" href="{{ url('/schedule') }}">
                Xem chuyến bay <span class="material-icons text-sm ml-1">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($hotDeals as $deal)
            <a href="{{ url('/schedule?to=' . urlencode($deal->name . ' (' . $deal->code . ')' )) }}"
                class="group bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all block">
                <div class="relative h-44 overflow-hidden bg-gradient-to-br from-blue-500 to-indigo-700 flex items-center justify-center">
                    <span class="material-icons text-white text-7xl opacity-20 group-hover:opacity-30 transition">flight</span>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-4">
                        <span class="text-4xl font-extrabold tracking-widest">{{ $deal->code }}</span>
                        <span class="text-sm font-medium mt-1 opacity-80">{{ $deal->subRegion->region->name ?? '' }}</span>
                    </div>
                    <div class="absolute top-3 left-3 bg-orange-500 text-white px-2.5 py-1 rounded-full text-xs font-bold uppercase">
                        Giá tốt
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold mb-1">{{ $deal->name }}</h3>
                    <p class="text-slate-400 text-xs mb-4">Mã sân bay: {{ $deal->code }}</p>
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-xs text-slate-400 mb-0.5">Giá chỉ từ</div>
                            <div class="text-primary text-xl font-bold">{{ number_format($deal->min_price, 0, ',', '.') }}đ</div>
                        </div>
                        <span class="bg-blue-50 text-primary dark:bg-blue-900/30 dark:text-blue-300 px-4 py-2 rounded-lg font-semibold text-sm group-hover:bg-primary group-hover:text-white transition">
                            Đặt ngay
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <p class="col-span-3 text-slate-400 text-center py-8">Chưa có dữ liệu ưu đãi. Hãy thêm giá khoảng cho sân bay trong trang quản trị.</p>
            @endforelse
        </div>
    </section>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold mb-6">Điểm đến phổ biến tại Việt Nam</h2>
            <div class="space-y-3">
                @forelse($popularRoutes as $route)
                <a href="{{ url('/schedule?to=' . urlencode($route->name . ' (' . $route->code . ')')) }}"
                    class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between hover:border-primary hover:shadow-md transition group block">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 dark:bg-blue-900/40 p-3 rounded-full text-primary shrink-0">
                            <span class="material-icons">flight_takeoff</span>
                        </div>
                        <div>
                            <div class="font-bold text-lg flex items-center gap-2">
                                {{ $route->name }}
                                <span class="text-xs font-bold bg-slate-100 dark:bg-slate-700 text-slate-500 px-2 py-0.5 rounded">{{ $route->code }}</span>
                            </div>
                            <div class="text-slate-500 text-sm">Chỉ từ <strong class="text-primary">{{ number_format($route->base_price, 0, ',', '.') }}đ</strong>/chiều</div>
                        </div>
                    </div>
                    <span class="border border-primary text-primary px-5 py-2 rounded-xl font-bold group-hover:bg-primary group-hover:text-white transition text-sm shrink-0">
                        Đặt ngay
                    </span>
                </a>
                @empty
                <p class="text-slate-400 py-4">Chưa có dữ liệu tuyến bay.</p>
                @endforelse
            </div>
        </div>
        <div>
            <h2 class="text-2xl font-bold mb-6">Thông tin ưu đãi</h2>
            <div class="relative rounded-2xl overflow-hidden h-full min-h-[300px] shadow-lg group">
                <img alt="Bãi biển mùa hè"
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBH1WI9wupearSURRYyxiuNR1njnsxDvsyZ1XrU1XhO1WapqHTyvESMM9tZotf0cMTnK6UIdFjIUDiLa59dNdGUjUBrBWV5rYq4tIq9KxsqxBIFKBWPqhaJY-FIjNA3bCAGpmYAX8D-wGZZ_qLWvr2h4edftbaXutHBJWAWKHY4dopDC3Kwx1UaJx_uJC94gM3WT09FArlKseo_SBc0db_8J-Gkucv25wbiexUNhrXuzWnpuvXS42-oItXJI1MpGeTjWN-1qrm5JzM" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-8 text-white">
                    <span
                        class="bg-white/20 backdrop-blur-sm text-xs font-bold uppercase tracking-widest px-3 py-1 rounded mb-3 w-fit">Chương
                        trình hè</span>
                    <h3 class="text-3xl font-bold mb-2">Summer Sale!</h3>
                    <p class="text-slate-200 mb-6">Giảm đến 40% toàn bộ vé máy bay nội địa và quốc tế trong
                        tháng 7.</p>
                    <button
                        class="bg-white text-primary py-3 rounded-xl font-bold hover:bg-blue-50 transition w-full">Tìm
                        hiểu thêm</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Blog Section --}}
<section class="container mx-auto px-6 py-16">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-bold">Cẩm nang & Kinh nghiệm</h2>
            <p class="text-slate-500 dark:text-slate-400">Những bài viết mới nhất từ giabaotravel</p>
        </div>
        <a class="text-primary font-semibold flex items-center hover:underline" href="{{ url('/tin-tuc') }}">
            Xem tất cả <span class="material-icons text-sm ml-1">arrow_forward</span>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($latestBlogs as $blog)
        <article class="flex flex-col bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-800 group hover:shadow-xl transition-all duration-300">
            <a href="{{ url('/tin-tuc/' . $blog->slug) }}" class="block">
                <div class="aspect-video w-full overflow-hidden relative">
                    <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                        style="background-image: url('{{ $blog->image_url ?? 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80' }}');">
                    </div>
                    <span class="absolute top-4 left-4 text-[10px] font-bold text-white uppercase bg-primary px-2.5 py-1 rounded shadow-sm">{{ $blog->category }}</span>
                </div>
            </a>
            <div class="p-6 flex flex-col flex-1">
                <div class="flex items-center gap-2 mb-3 text-slate-500 text-xs font-medium">
                    <span class="material-icons text-sm">calendar_today</span>
                    <span>{{ $blog->published_at ? $blog->published_at->format('d/m/Y') : '' }}</span>
                </div>
                <h3 class="text-slate-900 dark:text-white text-xl font-bold mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-tight">
                    <a href="{{ url('/tin-tuc/' . $blog->slug) }}">{{ $blog->title }}</a>
                </h3>
                <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6 line-clamp-3">{{ $blog->excerpt }}</p>
                <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <a class="text-primary text-sm font-bold flex items-center gap-1" href="{{ url('/tin-tuc/' . $blog->slug) }}">
                        Đọc thêm <span class="material-icons text-base">arrow_forward</span>
                    </a>
                    <span class="text-slate-400 text-[11px] flex items-center gap-1 uppercase font-bold tracking-wider">
                        <span class="material-icons text-sm">timer</span> {{ $blog->read_time }} phút
                    </span>
                </div>
            </div>
        </article>
        @empty
        <p class="text-slate-500 col-span-3 text-center py-8">Đang cập nhật bài viết...</p>
        @endforelse
    </div>
</section>

{{-- FAQ Section --}}
<section class="bg-slate-50 dark:bg-slate-800/50 py-16">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-3">Câu hỏi thường gặp</h2>
            <p class="text-slate-500 dark:text-slate-400">Tham khảo thông tin hữu ích để chuẩn bị tốt nhất cho chuyến bay</p>
        </div>
        <div class="space-y-4">
            <details class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-6 text-lg">
                    <span>Giấy tờ cần thiết khi đi máy bay là gì?</span>
                    <span class="transition group-open:rotate-180 material-icons text-primary">expand_more</span>
                </summary>
                <div class="text-slate-600 dark:text-slate-400 px-6 pb-6 leading-relaxed border-t border-slate-100 dark:border-slate-700 pt-4">
                    Đối với chuyến bay nội địa, bạn cần CMND/CCCD, Hộ chiếu hoặc Giấy phép lái xe. Trẻ em dưới 14 tuổi cần Giấy khai sinh bản gốc. Chuyến bay quốc tế yêu cầu Hộ chiếu và Visa (nếu nước đến yêu cầu).
                </div>
            </details>
            <details class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-6 text-lg">
                    <span>Quy định về hành lý xách tay và ký gửi?</span>
                    <span class="transition group-open:rotate-180 material-icons text-primary">expand_more</span>
                </summary>
                <div class="text-slate-600 dark:text-slate-400 px-6 pb-6 leading-relaxed border-t border-slate-100 dark:border-slate-700 pt-4">
                    <strong>Hành lý xách tay:</strong> tối đa 7-10kg, kích thước 56×36×23cm. <strong>Hành lý ký gửi:</strong> 20-32kg tùy hạng vé. Không để pin sạc dự phòng, vật phẩm có giá trị trong hành lý ký gửi.
                </div>
            </details>
            <details class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-6 text-lg">
                    <span>Có thể đổi/trả vé sau khi đã đặt không?</span>
                    <span class="transition group-open:rotate-180 material-icons text-primary">expand_more</span>
                </summary>
                <div class="text-slate-600 dark:text-slate-400 px-6 pb-6 leading-relaxed border-t border-slate-100 dark:border-slate-700 pt-4">
                    Tùy hạng vé: <strong>Vé khuyến mãi</strong> thường không hoàn, đổi có phí cao. <strong>Vé phổ thông/thương gia</strong> hỗ trợ hoàn/đổi (thu phí chênh lệch tùy hãng). Liên hệ hotline giabaotravel để được hỗ trợ.
                </div>
            </details>
            <details class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-6 text-lg">
                    <span>Cần đến sân bay trước bao lâu?</span>
                    <span class="transition group-open:rotate-180 material-icons text-primary">expand_more</span>
                </summary>
                <div class="text-slate-600 dark:text-slate-400 px-6 pb-6 leading-relaxed border-t border-slate-100 dark:border-slate-700 pt-4">
                    <strong>Bay nội địa:</strong> nên đến trước 2 tiếng. <strong>Bay quốc tế:</strong> nên đến trước 3 tiếng. Quầy check-in thường đóng trước giờ bay 40-60 phút.
                </div>
            </details>
            <details class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-6 text-lg">
                    <span>Những vật phẩm nào bị cấm mang lên máy bay?</span>
                    <span class="transition group-open:rotate-180 material-icons text-primary">expand_more</span>
                </summary>
                <div class="text-slate-600 dark:text-slate-400 px-6 pb-6 leading-relaxed border-t border-slate-100 dark:border-slate-700 pt-4">
                    Cấm mang: vật nhọn, vũ khí, chất lỏng trên 100ml (hành lý xách tay), chất dễ cháy nổ. Chất lỏng phải đựng trong chai ≤100ml và để trong túi zip trong suốt.
                </div>
            </details>
        </div>
        <div class="text-center mt-8">
            <a href="https://www.vietnamairlines.com/vn/vi/support/faq" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-primary hover:underline font-semibold bg-white dark:bg-slate-800 px-6 py-3 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 transition hover:shadow-md">
                Xem thêm FAQ từ Vietnam Airlines <span class="material-icons text-sm ml-2">open_in_new</span>
            </a>
        </div>
    </div>
</section>

{{-- Airline Partners Section --}}
<section class="py-16 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="container mx-auto px-6 mb-10 text-center max-w-3xl">
        <h2 class="text-3xl font-bold mb-4">Đối tác hãng bay & khách sạn!</h2>
        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
            Easybooking tự hào kết nối API trực tiếp với các hãng hàng không nội địa, hãng quốc tế đến Việt Nam và hơn 900 hãng trên toàn thế giới.
        </p>
    </div>

    @php
    $airlines = [
    ['iata' => 'VN', 'name' => 'Vietnam Airlines'],
    ['iata' => 'VJ', 'name' => 'Vietjet Air'],
    ['iata' => 'QH', 'name' => 'Bamboo Airways'],
    ['iata' => 'VU', 'name' => 'Vietravel Airlines'],
    ['iata' => 'KE', 'name' => 'Korean Air'],
    ['iata' => 'OZ', 'name' => 'Asiana Airlines'],
    ['iata' => 'PG', 'name' => 'Bangkok Airways'],
    ['iata' => 'CX', 'name' => 'Cathay Pacific'],
    ['iata' => 'CI', 'name' => 'China Airlines'],
    ['iata' => 'CZ', 'name' => 'China Southern'],
    ['iata' => 'EK', 'name' => 'Emirates'],
    ['iata' => 'EY', 'name' => 'Etihad'],
    ['iata' => 'JL', 'name' => 'Japan Airlines'],
    ['iata' => 'QR', 'name' => 'Qatar Airways'],
    ['iata' => 'SQ', 'name' => 'Singapore Airlines'],
    ['iata' => 'TG', 'name' => 'Thai Airways'],
    ['iata' => 'TK', 'name' => 'Turkish Airlines'],
    ['iata' => 'UA', 'name' => 'United Airlines'],
    ['iata' => 'AF', 'name' => 'Air France'],
    ['iata' => 'NZ', 'name' => 'Air New Zealand'],
    ['iata' => 'NH', 'name' => 'All Nippon Airways'],
    ['iata' => 'AA', 'name' => 'American Airlines'],
    ['iata' => 'BR', 'name' => 'Eva Air'],
    ['iata' => 'QF', 'name' => 'Qantas'],
    ['iata' => 'DL', 'name' => 'Delta Airlines'],
    ['iata' => 'MH', 'name' => 'Malaysia Airlines'],
    ['iata' => 'AK', 'name' => 'AirAsia'],
    ['iata' => 'JQ', 'name' => 'Jetstar'],
    ['iata' => 'LY', 'name' => 'El Al Israel Airlines'],
    ['iata' => 'B7', 'name' => 'UNI AIR'],
    ['iata' => 'MK', 'name' => 'Air Mauritius'],
    ['iata' => 'NX', 'name' => 'Air Macau'],
    ['iata' => 'AC', 'name' => 'Air Canada'],
    ];
    @endphp

    <style>
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-100% / 2));
            }
        }

        .animate-scroll {
            animation: scroll 40s linear infinite;
            display: flex;
            width: max-content;
        }

        .animate-scroll:hover {
            animation-play-state: paused;
        }
    </style>

    <div class="relative max-w-[100vw] overflow-hidden group">
        <div class="animate-scroll items-center gap-8 px-4">
            {{-- Loop twice for infinite scroll effect --}}
            @for($i=0; $i<2; $i++)
                @foreach($airlines as $airline)
                <div class="flex flex-col items-center justify-center w-[120px] grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100 cursor-pointer shrink-0">
                <div class="h-16 w-16 mb-3 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center p-2 shadow-sm border border-slate-100 dark:border-slate-700">
                    <img src="https://images.kiwi.com/airlines/64/{{ $airline['iata'] }}.png" alt="{{ $airline['name'] }}" class="max-w-full max-h-full object-contain">
                </div>
                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center line-clamp-2 leading-tight w-full">{{ $airline['name'] }}</span>
        </div>
        @endforeach
        @endfor
    </div>
    {{-- Gradients for smooth edges --}}
    <div class="absolute top-0 left-0 bottom-0 w-24 bg-gradient-to-r from-white dark:from-slate-900 to-transparent z-10 pointer-events-none"></div>
    <div class="absolute top-0 right-0 bottom-0 w-24 bg-gradient-to-l from-white dark:from-slate-900 to-transparent z-10 pointer-events-none"></div>
    </div>
</section>

@endsection