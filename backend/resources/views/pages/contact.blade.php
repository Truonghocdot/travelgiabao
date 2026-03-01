@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')


<div class="container mx-auto px-6 py-16 flex-grow">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-4">Liên hệ với chúng tôi</h1>
        <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto mb-8">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn 24/7. Hãy gọi hoặc gửi tin nhắn, chúng tôi sẽ phản hồi sớm nhất.</p>

        <!-- Staff Banner Image -->
        <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-xl mb-12 border-4 border-white dark:border-slate-800">
            <img src="{{ asset('staff.png') }}" alt="Gia Bảo Travel Staff" class="w-full h-auto object-cover">
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
        <!-- Contact Form -->
        <div class="order-2 lg:order-1">
            <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-lg border border-slate-100 dark:border-slate-700 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
                <h2 class="text-2xl font-bold mb-6">Gửi tin nhắn</h2>
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                    <span class="material-icons text-green-500">check_circle</span>
                    {{ session('success') }}
                </div>
                @endif
                <form action="{{ url('/lien-he') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Họ và tên</label>
                        <input type="text" name="customer_name" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="Nhập tên của bạn" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Số điện thoại</label>
                        <input type="tel" name="customer_phone" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="Vd: 0912 345 678" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Email (tùy chọn)</label>
                        <input type="email" name="customer_email" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="email@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nội dung</label>
                        <textarea rows="4" name="customer_note" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3 resize-none" placeholder="Bạn cần hỗ trợ gì? (hành trình, ngày bay, số lượng người...)" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:scale-[1.02]">Gửi yêu cầu</button>
                </form>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="space-y-8 flex flex-col justify-start order-1 lg:order-2">

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-primary transition overflow-hidden">
                <img src="{{ asset('adres.png') }}" alt="Gia Bảo Travel Office" class="w-full h-64 object-cover">
                <div class="p-6 flex items-start space-x-6">
                    <div class="bg-primary/10 text-primary p-4 rounded-full shrink-0">
                        <span class="material-icons text-3xl">location_on</span>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-2">Trụ sở chính</h4>
                        <p class="text-slate-600 dark:text-slate-400">129/20 <br>Phan Đình Phùng<br>Thành phố  Cam Ranh, Khánh Hòa</p>
                    </div>
                </div>
            </div>

            <div class="flex items-start space-x-6 p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-green-500 transition">
                <div class="bg-green-500/10 text-green-500 p-4 rounded-full">
                    <span class="material-icons text-3xl">call</span>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Đường dây nóng (24/7)</h4>
                    <p class="text-slate-600 dark:text-slate-400 font-medium text-lg">0981119692<br>
                        <span class="text-sm font-normal text-slate-500 mt-1 block">Giải đáp thắc mắc và hỗ trợ đặt vé khẩn cấp</span>
                    </p>
                </div>
            </div>

            <div class="flex items-start space-x-6 p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-orange-500 transition">
                <div class="bg-orange-500/10 text-orange-500 p-4 rounded-full">
                    <span class="material-icons text-3xl">mail</span>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Email hỗ trợ</h4>
                    <a href="mailto:support@giabaotravel.com" class="text-primary hover:underline font-medium text-lg">phongvemaybaygiare668@gmail.com</a>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">Phản hồi chậm nhất trong 24 giờ</p>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection