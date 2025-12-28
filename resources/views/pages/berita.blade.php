@extends('layouts.app')

@section('title', 'Berita - Dinas Lingkungan Hidup')

@section('content')
    <section class="mt-20 pb-16 px-4 md:px-12 lg:px-20 min-h-screen"> 
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <h2 class="text-3xl font-normal text-primary font-montserrat">Berita Terkini</h2>
            
            {{-- PERBAIKAN: Form Search --}}
            <form action="{{ route('news.index') }}" method="GET" class="relative w-full max-w-xs">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari Berita..." 
                    class="w-full p-2 pl-4 pr-10 border border-gray-300 rounded-full text-base font-sans outline-none focus:border-primary shadow-sm"
                >
                <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        {{-- Menampilkan pesan jika sedang melakukan pencarian --}}
        @if(request('search'))
            <p class="mb-6 text-gray-600">
                Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong> 
                <a href="{{ route('news.index') }}" class="text-red-500 text-sm ml-2 underline">Hapus Pencarian</a>
            </p>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-12">
            @forelse ($news as $article)
            <div class="rounded-xl overflow-hidden shadow-lg bg-white flex flex-col h-full transform hover:scale-[1.02] transition-transform duration-300">
                {{-- Pemanggilan Gambar Berita dari Supabase S3 --}}
                <div class="h-44 bg-cover bg-no-repeat bg-center flex-shrink-0"
                    style="background-image: url('{{ $article->image ? Storage::disk('s3')->url($article->image) : asset('truckSampah.png') }}');">
                </div>
                
                <div class="bg-secondary p-4 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-dlh-dark mb-2 leading-snug font-montserrat">
                            {{ Str::limit($article->title, 60) }}
                        </h3>
                        <p class="text-sm text-[#555] leading-snug mb-3">
                            {{ Str::limit($article->excerpt, 100) }}
                        </p>
                    </div>
                    <a href="{{ route('news.show', $article->slug) }}" class="text-sm font-semibold text-primary hover:text-opacity-80 transition-colors">
                        Baca selengkapnya
                    </a>
                </div>
            </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">search_off</span>
                    <p class="text-gray-500 text-lg">Tidak ada berita yang ditemukan dengan kata kunci tersebut.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center items-center gap-2 mt-8">
            {{ $news->links() }} 
        </div>
    </section>
@endsection
