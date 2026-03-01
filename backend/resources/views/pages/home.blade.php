@extends('layouts.app')

@section('title', 'Tìm kiếm vé máy bay giá rẻ')
@section('meta_description', 'Đặt vé máy bay giá rẻ tất cả hãng bay - Vietnam Airlines, Vietjet Air, Bamboo Airways. So sánh giá và đặt vé nhanh nhất tại giabaotravel.')
@section('meta_keywords', 'vé máy bay giá rẻ, đặt vé máy bay, Vietnam Airlines, Vietjet Air, Bamboo Airways, giabaotravel')

@section('content')

<section class="relative h-[550px] w-full flex items-center justify-center overflow-hidden">
    <img alt="Máy bay trên bầu trời xanh" class="absolute inset-0 w-full h-full object-cover brightness-75"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOUNqqqV_GMB7B85V3pW52tXW9MYMC-Y3rAm4KsxO72imzty5ThzU1oHd7-Y4VH41km7JLYWPHatLT3f8I34fdPfsiQ290GqgWEGIS-Sn0MtsdjxmqbjkfYwnGm5GfAY9UZtGkUm8dAgNgZUwAFj6NyWoUTEX6DExwtTyzXelPPizXZPIpc-GzKeyTUcmTwDTPsa6Tb8mfeBj24AxEgzIqUmw-SVTesqUcbutycPfAZEQEQg2GYrp2UML_rg6q78NsMoD8B1M1pD4" />
    <div class="absolute inset-0 bg-gradient-to-b from-primary/30 to-transparent"></div>
    <div class="relative z-10 w-full max-w-5xl px-6">
        <div
            class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/20">
            <div class="flex justify-center mb-6">
                <div class="inline-flex p-1 bg-slate-200 dark:bg-slate-700 rounded-xl">
                    <button
                        class="px-6 py-2 rounded-lg text-sm font-semibold transition bg-white dark:bg-slate-600 shadow-sm">Khứ
                        hồi</button>
                    <button
                        class="px-6 py-2 rounded-lg text-sm font-semibold transition hover:bg-white/50 dark:hover:bg-slate-600/50">Một
                        chiều</button>
                    <button
                        class="px-6 py-2 rounded-lg text-sm font-semibold transition hover:bg-white/50 dark:hover:bg-slate-600/50">Nhiều
                        chặng</button>
                </div>
            </div>
            <form action="{{ url('/schedule') }}" method="GET" class="w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="relative">
                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Điểm khởi hành</label>
                        <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                            <span class="material-icons text-slate-400 mr-2">flight_takeoff</span>
                            <select name="from" class="bg-transparent border-none focus:ring-0 w-full p-0 outline-none">
                                @foreach($regions as $region)
                                <optgroup label="{{ $region->name }}">
                                    @foreach($region->subRegions as $sub)
                                    @foreach($sub->airports as $ap)
                                    <option value="{{ $ap->name }} ({{ $ap->code }})" {{ $ap->code == 'SGN' ? 'selected' : '' }}>{{ $ap->name }} ({{ $ap->code }})</option>
                                    @endforeach
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="relative">
                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Điểm đến</label>
                        <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                            <span class="material-icons text-slate-400 mr-2">flight_land</span>
                            <select name="to" class="bg-transparent border-none focus:ring-0 w-full p-0 outline-none">
                                @foreach($regions as $region)
                                <optgroup label="{{ $region->name }}">
                                    @foreach($region->subRegions as $sub)
                                    @foreach($sub->airports as $ap)
                                    <option value="{{ $ap->name }} ({{ $ap->code }})" {{ $ap->code == 'HAN' ? 'selected' : '' }}>{{ $ap->name }} ({{ $ap->code }})</option>
                                    @endforeach
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="relative">
                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Ngày đi - Ngày về</label>
                        <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                            <span class="material-icons text-slate-400 mr-2">calendar_today</span>
                            <input name="date" class="bg-transparent border-none focus:ring-0 w-full p-0" placeholder="25/12/2023 - 30/12/2023" value="25/12/2023 - 30/12/2023" type="text" />
                        </div>
                    </div>
                    <div class="relative">
                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Số hành khách</label>
                        <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                            <span class="material-icons text-slate-400 mr-2">group</span>
                            <select name="passengers" class="bg-transparent border-none focus:ring-0 w-full p-0 outline-none">
                                <option value="1 người lớn, Phổ thông">1 người lớn, Phổ thông</option>
                                <option value="2 người lớn, Phổ thông">2 người lớn, Phổ thông</option>
                                <option value="1 người lớn, Thương gia">1 người lớn, Thương gia</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg flex items-center justify-center space-x-2 transition-all transform hover:scale-[1.01] active:scale-95">
                    <span class="material-icons">search</span>
                    <span>Tìm kiếm chuyến bay</span>
                </button>
            </form>
        </div>
    </div>
</section>
<div class="container mx-auto px-6 py-16 space-y-20">
    <section>
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold">Ưu đãi hot</h2>
                <p class="text-slate-500 dark:text-slate-400">Những khuyến mại hấp dẫn nhất dành riêng cho bạn
                </p>
            </div>
            <a class="text-primary font-semibold flex items-center hover:underline" href="#">
                Xem tất cả <span class="material-icons text-sm ml-1">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="group bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all">
                <div class="relative h-48 overflow-hidden">
                    <img alt="Tokyo"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlLCv4lf1vHa-1-tiuUVzKqi2jZxuiGOsRYNay4fRVG6lNeK5yrjSydMMqhTvAKSOR5BzCEdhdpQ-mhXamZyO7Ma0LmuR1_rWG-FtxRkiWHNh8kiWubDPhTe9pqfbV63jbDBfC9BEVBTwM7lnWZpn_HjSdhk_7_h9VSJ2KhASjJQD1S67XuNZaTTZKlhCNAklG25-IN8fFWaucg1uLjcksOHd4bx_5jEJ8dxMr6zaehVayH8BJFttY3FRWzaTfWKpCzDgT6r5pGqc" />
                    <div
                        class="absolute top-4 left-4 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                        Giảm 20%</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-1">Tokyo, Nhật Bản</h3>
                    <p class="text-slate-500 text-sm mb-4">Hành trình 5 ngày khám phá văn hóa</p>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-slate-400 text-sm line-through">12.500.000đ</span>
                            <div class="text-primary text-xl font-bold">9.900.000đ</div>
                        </div>
                        <button
                            class="bg-blue-50 text-primary dark:bg-blue-900/30 dark:text-blue-300 px-4 py-2 rounded-lg font-semibold hover:bg-primary hover:text-white transition">Chi
                            tiết</button>
                    </div>
                </div>
            </div>
            <div
                class="group bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all">
                <div class="relative h-48 overflow-hidden">
                    <img alt="Bangkok"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC1vWCqa2CL8p7NMyOpR--Njmp8wXqWcCk1Vnu4brPLSkeyYOSb263fHC-hM0zWtBoUDHu9byQjv6b8O_YZILXEEif9cq6hCYZu9qmfcVoVMRar3Bih4vzjjo4voeAM0rOHe2OUZSFrM3OXRD5O3G9VJhgWHhw6XqaSlaYqvENcGrwWtSPwP-VOnfR7NNyY7arbNghr8BkiP3qbPp95hmVcqlXZOwJCFsn0AESc-hKNfvqi_ifwRM4PS_6Y2WNqoiIacusaG-aLxAQ" />
                    <div
                        class="absolute top-4 left-4 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                        Giá sốc</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-1">Bangkok, Thái Lan</h3>
                    <p class="text-slate-500 text-sm mb-4">Nghỉ dưỡng cuối tuần tại Bangkok</p>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-slate-400 text-sm line-through">4.500.000đ</span>
                            <div class="text-primary text-xl font-bold">3.200.000đ</div>
                        </div>
                        <button
                            class="bg-blue-50 text-primary dark:bg-blue-900/30 dark:text-blue-300 px-4 py-2 rounded-lg font-semibold hover:bg-primary hover:text-white transition">Chi
                            tiết</button>
                    </div>
                </div>
            </div>
            <div
                class="group bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all">
                <div class="relative h-48 overflow-hidden">
                    <img alt="Singapore"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbHS2HMbap4vW6GfyDJLywyqdEf3Q-TxYc_kQEBQRXNNmxPJKVJfmsATlJlfz6IQWfkPsV2iVVppNRYKOlgm9L5aPbzoz-fYg5lJbqW8xTYGa5i82eYhhwmpKx1-aG-fsgZRRxCpaxLKePklElmaWaqUnQMvPk4b3braUqxYUbq3ul2hLCnC4dC-PQ4OWMoTQGXeFlbO2ZL2Rp92nkVsyug86WC-yYNdAdMyxsPXttfu3crTJhwpzaAdEKT0M_8eu2QyfnEEdLAss" />
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-1">Singapore</h3>
                    <p class="text-slate-500 text-sm mb-4">Khám phá đảo quốc sư tử</p>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-slate-400 text-sm line-through">6.800.000đ</span>
                            <div class="text-primary text-xl font-bold">5.500.000đ</div>
                        </div>
                        <button
                            class="bg-blue-50 text-primary dark:bg-blue-900/30 dark:text-blue-300 px-4 py-2 rounded-lg font-semibold hover:bg-primary hover:text-white transition">Chi
                            tiết</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold mb-6">Điểm đến phổ biến</h2>
            <div class="space-y-4">
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between hover:border-primary transition">
                    <div class="flex items-center space-x-6">
                        <div class="bg-blue-100 dark:bg-blue-900/40 p-3 rounded-full text-primary">
                            <span class="material-icons">flight_takeoff</span>
                        </div>
                        <div>
                            <div class="font-bold text-lg">Hà Nội <span
                                    class="material-icons text-sm align-middle mx-2 text-slate-400">arrow_forward</span>
                                TP. Hồ Chí Minh</div>
                            <div class="text-slate-500 text-sm">Chỉ từ 890.000đ/chiều</div>
                        </div>
                    </div>
                    <button
                        class="border border-primary text-primary px-6 py-2 rounded-xl font-bold hover:bg-primary hover:text-white transition">Đặt
                        ngay</button>
                </div>
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between hover:border-primary transition">
                    <div class="flex items-center space-x-6">
                        <div class="bg-blue-100 dark:bg-blue-900/40 p-3 rounded-full text-primary">
                            <span class="material-icons">flight_takeoff</span>
                        </div>
                        <div>
                            <div class="font-bold text-lg">Đà Nẵng <span
                                    class="material-icons text-sm align-middle mx-2 text-slate-400">arrow_forward</span>
                                Seoul (Hàn Quốc)</div>
                            <div class="text-slate-500 text-sm">Chỉ từ 3.200.000đ/chiều</div>
                        </div>
                    </div>
                    <button
                        class="border border-primary text-primary px-6 py-2 rounded-xl font-bold hover:bg-primary hover:text-white transition">Đặt
                        ngay</button>
                </div>
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between hover:border-primary transition">
                    <div class="flex items-center space-x-6">
                        <div class="bg-blue-100 dark:bg-blue-900/40 p-3 rounded-full text-primary">
                            <span class="material-icons">flight_takeoff</span>
                        </div>
                        <div>
                            <div class="font-bold text-lg">Nha Trang <span
                                    class="material-icons text-sm align-middle mx-2 text-slate-400">arrow_forward</span>
                                Đài Bắc</div>
                            <div class="text-slate-500 text-sm">Chỉ từ 4.500.000đ/chiều</div>
                        </div>
                    </div>
                    <button
                        class="border border-primary text-primary px-6 py-2 rounded-xl font-bold hover:bg-primary hover:text-white transition">Đặt
                        ngay</button>
                </div>
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

@endsection