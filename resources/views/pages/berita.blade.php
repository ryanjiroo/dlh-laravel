@extends('layouts.app')

@section('title', 'Berita - Dinas Lingkungan Hidup')

@section('content')
    <section class="mt-20 pb-16 px-4 md:px-12 lg:px-20 min-h-screen"> 
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <h2 class="text-3xl font-normal text-primary font-montserrat">Berita Terkini</h2>
            <div class="relative w-full max-w-xs">
                <input type="text" placeholder="Cari Berita" class="w-full p-2 pl-4 pr-10 border border-gray-300 rounded-full text-base font-sans outline-none focus:border-primary">
                <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-12">
            @forelse ($news as $article)
            <div class="rounded-xl overflow-hidden shadow-lg bg-white">
                {{-- Pemanggilan Gambar Berita --}}
                <div class="h-44 bg-cover bg-no-repeat bg-center-top bg-[#ccc] flex-shrink-0"
                    style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : asset('truckSampah.png') }}');">
                </div>
                <div class="bg-secondary p-4 min-h-[150px] flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-dlh-dark mb-2 leading-snug font-montserrat">{{ $article->title }}</h3>
                        <p class="text-sm text-[#555] leading-snug mb-3">{{ $article->excerpt }}</p>
                    </div>
                    <a href="{{ route('news.show', $article->slug) }}" class="text-sm font-semibold text-primary hover:text-opacity-80 transition-colors">Baca selengkapnya</a>
                </div>
            </div>
            @empty
                <p>Tidak ada berita yang ditemukan.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center items-center gap-2 mt-8">
            {{ $news->links() }} 
        </div>
    </section>
@endsection