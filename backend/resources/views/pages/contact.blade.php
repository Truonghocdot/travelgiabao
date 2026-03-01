@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')


<div class="container mx-auto px-6 py-16 flex-grow">
    <div class="text-center mb-16">
        <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-4">Liên hệ với chúng tôi</h1>
        <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn 24/7. Hãy gọi hoặc gửi tin nhắn, chúng tôi sẽ phản hồi sớm nhất.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto">
        <!-- Contact Form -->
        <div>
            <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-lg border border-slate-100 dark:border-slate-700 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
                <h2 class="text-2xl font-bold mb-6">Gửi tin nhắn</h2>
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Họ và tên</label>
                        <input type="text" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="Nhập tên của bạn" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                        <input type="email" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="email@example.com" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Số điện thoại</label>
                        <input type="tel" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="Vd: 0912 345 678" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nội dung</label>
                        <textarea rows="4" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3 resize-none" placeholder="Bạn cần hỗ trợ gì?" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:scale-[1.02]">Gửi yêu cầu</button>
                </form>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="space-y-8 flex flex-col justify-center">
            
            <div class="flex items-start space-x-6 p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-primary transition">
                <div class="bg-primary/10 text-primary p-4 rounded-full">
                    <span class="material-icons text-3xl">location_on</span>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Trụ sở chính</h4>
                    <p class="text-slate-600 dark:text-slate-400">Tầng 15, Tòa nhà Travel Center<br>123 Đường Du Lịch, Quận Hoàn Kiếm<br>Thủ đô Hà Nội, Việt Nam</p>
                </div>
            </div>

            <div class="flex items-start space-x-6 p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-green-500 transition">
                <div class="bg-green-500/10 text-green-500 p-4 rounded-full">
                    <span class="material-icons text-3xl">call</span>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Đường dây nóng (24/7)</h4>
                    <p class="text-slate-600 dark:text-slate-400 font-medium text-lg">1900 1234<br>
                    <span class="text-sm font-normal text-slate-500 mt-1 block">Giải đáp thắc mắc và hỗ trợ đặt vé khẩn cấp</span></p>
                </div>
            </div>

            <div class="flex items-start space-x-6 p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-orange-500 transition">
                <div class="bg-orange-500/10 text-orange-500 p-4 rounded-full">
                    <span class="material-icons text-3xl">mail</span>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Email hỗ trợ</h4>
                    <a href="mailto:support@giabaotravel.com" class="text-primary hover:underline font-medium text-lg">support@giabaotravel.com</a>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">Phản hồi chậm nhất trong 24 giờ</p>
                </div>
            </div>
            
        </div>
    </div>
</div>


@endsection
