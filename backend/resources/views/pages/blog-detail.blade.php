@extends('layouts.app')

@section('title', $blog->title)
@section('meta_description', $blog->excerpt ?? $blog->title)
@section('meta_keywords', $blog->category . ', du lịch, giabaotravel, ' . $blog->title)

@section('content')
<article class="container mx-auto px-6 py-10 max-w-4xl">
    {{-- Breadcrumb --}}
    <nav class="flex items-center text-sm text-slate-500 mb-8" aria-label="Breadcrumb">
        <a href="{{ url('/') }}" class="hover:text-primary transition">Trang chủ</a>
        <span class="material-icons text-xs mx-2">chevron_right</span>
        <a href="{{ url('/tin-tuc') }}" class="hover:text-primary transition">Tin tức</a>
        <span class="material-icons text-xs mx-2">chevron_right</span>
        <span class="text-slate-700 dark:text-slate-300 font-medium truncate max-w-[200px]">{{ $blog->title }}</span>
    </nav>

    {{-- Article Header --}}
    <header class="mb-8">
        <span class="inline-block bg-primary/10 text-primary text-xs font-bold uppercase px-3 py-1 rounded-lg mb-4">{{ $blog->category }}</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight mb-6">{{ $blog->title }}</h1>
        <div class="flex flex-wrap items-center gap-6 text-slate-500 text-sm">
            <span class="flex items-center gap-2">
                <span class="material-icons text-sm">person</span> {{ $blog->author }}
            </span>
            <span class="flex items-center gap-2">
                <span class="material-icons text-sm">calendar_today</span> {{ $blog->published_at ? $blog->published_at->format('d/m/Y') : '' }}
            </span>
            <span class="flex items-center gap-2">
                <span class="material-icons text-sm">timer</span> {{ $blog->read_time }} phút đọc
            </span>
        </div>
    </header>

    {{-- Featured Image --}}
    @if($blog->image_url)
    <div class="rounded-2xl overflow-hidden mb-10 shadow-lg">
        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-full h-auto object-cover max-h-[500px]" loading="lazy">
    </div>
    @endif

    {{-- Excerpt --}}
    @if($blog->excerpt)
    <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-primary p-6 rounded-r-2xl mb-10">
        <p class="text-slate-700 dark:text-slate-300 text-lg font-medium leading-relaxed italic">{{ $blog->excerpt }}</p>
    </div>
    @endif

    {{-- Content --}}
    <div class="prose prose-lg dark:prose-invert max-w-none mb-12
        prose-headings:font-bold prose-h2:text-2xl prose-h3:text-xl
        prose-p:text-slate-600 dark:prose-p:text-slate-400 prose-p:leading-relaxed
        prose-a:text-primary hover:prose-a:underline
        prose-img:rounded-xl prose-img:shadow-md">
        {!! $blog->content !!}
    </div>

    {{-- Share + Back --}}
    <div class="border-t border-slate-200 dark:border-slate-700 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
        <a href="{{ url('/tin-tuc') }}" class="inline-flex items-center text-primary font-bold hover:underline">
            <span class="material-icons mr-2">arrow_back</span> Quay lại danh sách
        </a>
        <div class="flex items-center gap-4">
            <span class="text-sm text-slate-500 font-medium">Chia sẻ:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-full hover:bg-blue-200 transition" aria-label="Share Facebook">
                <span class="material-icons text-blue-600 text-sm">facebook</span>
            </a>
            <button onclick="navigator.clipboard.writeText(window.location.href)" class="p-2 bg-slate-100 dark:bg-slate-800 rounded-full hover:bg-slate-200 transition" aria-label="Copy link">
                <span class="material-icons text-slate-600 text-sm">link</span>
            </button>
        </div>
    </div>

    {{-- Related Posts --}}
    @if($relatedBlogs->count())
    <section class="mt-16">
        <h2 class="text-2xl font-bold mb-8">Bài viết liên quan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedBlogs as $related)
            <a href="{{ url('/tin-tuc/' . $related->slug) }}" class="block group">
                <div class="bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-lg transition">
                    <div class="aspect-video bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                        style="background-image: url('{{ $related->image_url ?? 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=400&q=80' }}');">
                    </div>
                    <div class="p-4">
                        <span class="text-[10px] font-bold text-primary uppercase">{{ $related->category }}</span>
                        <h3 class="font-bold text-sm mt-1 line-clamp-2 group-hover:text-primary transition">{{ $related->title }}</h3>
                        <p class="text-xs text-slate-500 mt-2">{{ $related->read_time }} phút đọc</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</article>
@endsection