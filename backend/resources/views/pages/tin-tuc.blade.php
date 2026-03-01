@extends('layouts.app')

@section('title', 'Tin tức & Cẩm nang du lịch')
@section('meta_description', 'Cập nhật tin tức hàng không, mẹo du lịch, khuyến mãi vé máy bay và cẩm nang điểm đến từ giabaotravel.')
@section('meta_keywords', 'tin tức du lịch, mẹo du lịch, khuyến mãi vé máy bay, cẩm nang du lịch, giabaotravel')

@section('content')
<div class="container mx-auto px-6 py-10 max-w-7xl">
    {{-- Page Header --}}
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-3">Tin tức & Cẩm nang du lịch</h1>
        <p class="text-slate-500 dark:text-slate-400 text-lg">Khám phá những bài viết mới nhất về du lịch, hàng không và ưu đãi hấp dẫn.</p>
    </div>

    {{-- Featured Post --}}
    @if($featured)
    <article class="mb-12">
        <a href="{{ url('/tin-tuc/' . $featured->slug) }}" class="block group">
            <div class="relative rounded-2xl overflow-hidden bg-slate-900 aspect-[21/9] min-h-[350px] flex flex-col justify-end shadow-xl">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                    style="background-image: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0) 100%), url('{{ $featured->image_url ?? 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1200&q=80' }}');">
                </div>
                <div class="relative p-6 md:p-12 max-w-4xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-primary text-white text-xs font-bold uppercase tracking-wider rounded-md mb-4 shadow-lg">
                        <span class="material-icons text-sm">stars</span> Tin nổi bật
                    </span>
                    <h2 class="text-white text-3xl md:text-5xl font-extrabold leading-tight mb-4 tracking-tight drop-shadow-md">
                        {{ $featured->title }}
                    </h2>
                    <p class="text-slate-200 text-lg mb-6 line-clamp-2 max-w-2xl font-medium">{{ $featured->excerpt }}</p>
                    <div class="flex items-center gap-6">
                        <span class="flex items-center justify-center rounded-lg h-12 px-8 bg-white text-primary text-sm font-bold transition-all group-hover:bg-slate-100 group-hover:scale-105 shadow-lg">
                            Đọc chi tiết
                        </span>
                        <div class="flex items-center gap-3 text-slate-300 text-sm font-medium">
                            <span class="flex items-center gap-1"><span class="material-icons text-sm">schedule</span> {{ $featured->read_time }} phút đọc</span>
                            <span class="w-1 h-1 rounded-full bg-slate-500"></span>
                            <span class="flex items-center gap-1"><span class="material-icons text-sm">person</span> {{ $featured->author }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </article>
    @endif

    {{-- Category Tabs --}}
    <div class="mb-10 border-b border-slate-200 dark:border-slate-800">
        <div class="flex overflow-x-auto no-scrollbar gap-8 pb-px">
            <a class="flex flex-col items-center justify-center pb-4 whitespace-nowrap text-sm font-bold tracking-wide border-b-[3px] {{ !request('category') ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }} transition-colors" href="{{ url('/tin-tuc') }}">Tất cả</a>
            @foreach(['Cẩm nang', 'Tin hàng không', 'Mẹo du lịch', 'Khuyến mãi', 'Sự kiện', 'Cẩm nang điểm đến'] as $cat)
            <a class="flex flex-col items-center justify-center pb-4 whitespace-nowrap text-sm font-bold tracking-wide border-b-[3px] {{ request('category') === $cat ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }} transition-colors" href="{{ url('/tin-tuc?category=' . urlencode($cat)) }}">{{ $cat }}</a>
            @endforeach
        </div>
    </div>

    {{-- Blog Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($blogs as $blog)
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
                    <a class="text-primary text-sm font-bold flex items-center gap-1 group/link" href="{{ url('/tin-tuc/' . $blog->slug) }}">
                        Đọc thêm <span class="material-icons text-base transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                    </a>
                    <span class="text-slate-400 text-[11px] flex items-center gap-1 uppercase font-bold tracking-wider">
                        <span class="material-icons text-sm">timer</span> {{ $blog->read_time }} phút
                    </span>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-3 text-center py-16">
            <span class="material-icons text-5xl text-slate-300 mb-4">article</span>
            <p class="text-slate-500 text-lg">Chưa có bài viết nào trong danh mục này.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($blogs->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $blogs->appends(request()->query())->links('pagination::tailwind') }}
    </div>
    @endif
</div>
@endsection