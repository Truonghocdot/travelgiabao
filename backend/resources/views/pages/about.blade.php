@extends('layouts.app')

@section('title', 'Về chúng tôi')

@section('content')

            <section class="relative h-[500px] w-full flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center"
                    data-alt="Majestic mountain landscape with crystal clear lake"
                    style='background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuAnfV3RDITaqt8XvEC2vWLMqaiVZmifbSqxXNXme72BEAgU6gVOxINRpltdQoQAXJ9s-B4imPwdS3__eCG75oYu4_gDWzf0mRw7iXC-J3cjvBFbGSs8onlJWZxeFjcZj1KRN4HXZxmE1Bkcsuj6rGJ747wxD3Dp1kZ9NiGQ1_Na6AvTis2wUsbyJnp8MBmeumC_MtA5D-qA_AbKVL5Ow6rjZZsuSIKPWPpWLUmjtD43DVyAFLnuKRhmRpcT9aBXWiv5yW7TiIsaEGk");'>
                </div>
                <div class="relative z-10 text-center px-4 max-w-4xl">
                    <h1 class="text-white text-5xl md:text-6xl font-black mb-6 tracking-tight">Về giabaotravel</h1>
                    <p class="text-white/90 text-lg md:text-xl font-medium max-w-2xl mx-auto">
                        Chúng tôi là cánh cửa đưa bạn đến với những điểm đến ngoạn mục nhất thế giới. Chuyên nghiệp, tin
                        cậy và tận tâm trên mọi hành trình.
                    </p>
                    <div class="mt-10 flex justify-center gap-4">
                        <button
                            class="bg-primary text-white px-8 py-3 rounded-lg font-bold text-lg hover:scale-105 transition-transform">Khám
                            phá Tour</button>
                        <button
                            class="bg-white/20 backdrop-blur-md text-white border border-white/30 px-8 py-3 rounded-lg font-bold text-lg hover:bg-white/30 transition-all">Liên
                            hệ ngay</button>
                    </div>
                </div>
            </section>
            <div class="max-w-7xl mx-auto px-6 lg:px-10 py-16">
                <section class="mb-20">
                    <div class="flex flex-col lg:flex-row gap-12 items-center">
                        <div class="flex-1">
                            <span class="text-primary font-bold tracking-widest uppercase text-sm">Sứ mệnh của chúng
                                tôi</span>
                            <h2 class="text-slate-900 dark:text-slate-100 text-4xl font-black mt-4 mb-6 leading-tight">
                                Kết nối bạn với những chuyến đi trong mơ</h2>
                            <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-6">
                                Được xây dựng trên nền tảng của sự tin tưởng và xuất sắc, giabaotravel hướng tới việc
                                đơn giản hóa thế giới du lịch phức tạp. Chúng tôi cung cấp những trải nghiệm được chọn
                                lọc kỹ lưỡng, không chỉ dừng lại ở việc tham quan mà còn tập trung vào sự hòa nhập văn
                                hóa và những kỷ niệm khó quên.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div
                                    class="p-5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm">
                                    <span
                                        class="material-symbols-outlined text-primary text-3xl mb-3">verified_user</span>
                                    <h3 class="font-bold text-lg mb-2">Chính trực</h3>
                                    <p class="text-slate-500 text-sm">Giá cả minh bạch và các khuyến nghị trung thực là
                                        tiêu chuẩn hàng đầu của chúng tôi.</p>
                                </div>
                                <div
                                    class="p-5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm">
                                    <span class="material-symbols-outlined text-primary text-3xl mb-3">psychology</span>
                                    <h3 class="font-bold text-lg mb-2">Đổi mới</h3>
                                    <p class="text-slate-500 text-sm">Ứng dụng công nghệ hiện đại giúp việc đặt chỗ trở
                                        nên mượt mà như chuyến bay của bạn.</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl relative">
                                <img alt="Traveler planning a journey with a map and laptop"
                                    class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuASF-d28si7b06lacvklDrN1uZnmFP_icqgJisDfHDS3nta4MdHtcUQtG_omSCFXU-Be_WpbUEM0qmhUSC8SCCvAsLqBqjWsyo5H6fF_OmiyYcg-3elFTPWYEwhW4l_TnC-uk58bYcHpzlj3ynr6weBlxwejRw8Ja2XtzLdpG7tug0Y_EWur8wDGS5L7k1bCaQMtIS-CJqThVtSa5_BYm0E-6kHitzmOwUnVjwaIAF_4ZOWTgVUdyoNSWbXQhdLLN7aXNFleP6n3ZM" />
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mb-20 py-12 bg-slate-50 dark:bg-slate-900/50 rounded-3xl px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-slate-900 dark:text-slate-100 text-4xl font-black">Lịch sử hình thành</h2>
                        <p class="text-slate-500 mt-4">Hơn một thập kỷ dẫn đầu trong ngành du lịch</p>
                    </div>
                    <div
                        class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                        <div
                            class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-300 dark:bg-slate-700 text-slate-500 group-[.is-active]:bg-primary group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-colors duration-500">
                                <span class="material-symbols-outlined text-[18px]">flag</span>
                            </div>
                            <div
                                class="w-[calc(100%-4rem)] md:w-[45%] p-6 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm">
                                <div class="flex items-center justify-between space-x-2 mb-1">
                                    <div class="font-bold text-slate-900 dark:text-slate-100">Thành lập tại Hà Nội</div>
                                    <time class="font-display font-bold text-primary">2010</time>
                                </div>
                                <div class="text-slate-500 text-sm">Bắt đầu với một đội ngũ nhỏ gồm 5 người đam mê du
                                    lịch tại trung tâm thủ đô Việt Nam.</div>
                            </div>
                        </div>
                        <div
                            class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-300 dark:bg-slate-700 text-slate-500 group-[.is-active]:bg-primary group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                <span class="material-symbols-outlined text-[18px]">public</span>
                            </div>
                            <div
                                class="w-[calc(100%-4rem)] md:w-[45%] p-6 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm">
                                <div class="flex items-center justify-between space-x-2 mb-1">
                                    <div class="font-bold text-slate-900 dark:text-slate-100">Mở rộng khu vực</div>
                                    <time class="font-display font-bold text-primary">2015</time>
                                </div>
                                <div class="text-slate-500 text-sm">Mở văn phòng tại Thái Lan, Campuchia và Lào, trở
                                    thành đơn vị lữ hành hàng đầu Đông Nam Á.</div>
                            </div>
                        </div>
                        <div
                            class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-300 dark:bg-slate-700 text-slate-500 group-[.is-active]:bg-primary group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                <span class="material-symbols-outlined text-[18px]">devices</span>
                            </div>
                            <div
                                class="w-[calc(100%-4rem)] md:w-[45%] p-6 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm">
                                <div class="flex items-center justify-between space-x-2 mb-1">
                                    <div class="font-bold text-slate-900 dark:text-slate-100">Chuyển đổi số</div>
                                    <time class="font-display font-bold text-primary">2018</time>
                                </div>
                                <div class="text-slate-500 text-sm">Ra mắt nền tảng kỹ thuật số toàn diện giúp khách
                                    hàng đặt dịch vụ toàn cầu dễ dàng.</div>
                            </div>
                        </div>
                        <div
                            class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-300 dark:bg-slate-700 text-slate-500 group-[.is-active]:bg-primary group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                <span class="material-symbols-outlined text-[18px]">trophy</span>
                            </div>
                            <div
                                class="w-[calc(100%-4rem)] md:w-[45%] p-6 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm">
                                <div class="flex items-center justify-between space-x-2 mb-1">
                                    <div class="font-bold text-slate-900 dark:text-slate-100">Giải thưởng Đại lý xuất
                                        sắc</div>
                                    <time class="font-display font-bold text-primary">2023</time>
                                </div>
                                <div class="text-slate-500 text-sm">Được vinh danh là đối tác lữ hành đáng tin cậy nhất
                                    trong khu vực năm thứ 3 liên tiếp.</div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mb-10">
                    <div class="text-center mb-12">
                        <h2 class="text-slate-900 dark:text-slate-100 text-4xl font-black">Tại sao chọn giabaotravel?
                        </h2>
                        <p class="text-slate-500 mt-4 max-w-2xl mx-auto">Chúng tôi kết hợp sự am hiểu địa phương với
                            tiêu chuẩn dịch vụ quốc tế để mang lại sự an tâm tuyệt đối.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div
                            class="flex flex-col items-center text-center p-8 rounded-2xl bg-primary/5 dark:bg-primary/10 border border-primary/10">
                            <div
                                class="size-16 rounded-full bg-primary text-white flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-4xl">support_agent</span>
                            </div>
                            <h3 class="text-xl font-bold mb-4">Hỗ trợ 24/7</h3>
                            <p class="text-slate-600 dark:text-slate-400">Đội ngũ tận tâm luôn sẵn sàng hỗ trợ bạn bất
                                kể sự khác biệt về múi giờ.</p>
                        </div>
                        <div
                            class="flex flex-col items-center text-center p-8 rounded-2xl bg-primary/5 dark:bg-primary/10 border border-primary/10">
                            <div
                                class="size-16 rounded-full bg-primary text-white flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-4xl">sell</span>
                            </div>
                            <h3 class="text-xl font-bold mb-4">Cam kết giá tốt nhất</h3>
                            <p class="text-slate-600 dark:text-slate-400">Chúng tôi cung cấp mức giá cạnh tranh nhất mà
                                không làm giảm đi chất lượng trải nghiệm.</p>
                        </div>
                        <div
                            class="flex flex-col items-center text-center p-8 rounded-2xl bg-primary/5 dark:bg-primary/10 border border-primary/10">
                            <div
                                class="size-16 rounded-full bg-primary text-white flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-4xl">travel_explore</span>
                            </div>
                            <h3 class="text-xl font-bold mb-4">Am hiểu địa phương</h3>
                            <p class="text-slate-600 dark:text-slate-400">Hướng dẫn viên địa phương mang đến những kiến
                                thức thực tế và những điểm đến bí ẩn.</p>
                        </div>
                    </div>
                </section>
            </div>
        
@endsection
