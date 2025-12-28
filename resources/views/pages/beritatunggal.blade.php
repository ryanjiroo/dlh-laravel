@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <section class="py-16 px-4 md:px-12 lg:px-20 min-h-screen bg-gray-50 mt-10"> 
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            
            <h1 class="text-4xl font-extrabold text-gray-900 font-montserrat mb-4">{{ $article->title }}</h1>
            <div class="text-sm text-gray-500 mb-6 border-b pb-4">
                Dipublikasikan oleh <strong>{{ $article->author }}</strong> pada {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}
            </div>

            {{-- PERBAIKAN: Gambar Utama dari S3 Supabase --}}
            @if ($article->image)
                <div class="mb-8 overflow-hidden rounded-lg shadow-md">
                    <img 
                        src="{{ Storage::disk('s3')->url($article->image) }}" 
                        alt="{{ $article->title }}" 
                        class="w-full h-auto object-cover max-h-[500px]"
                    >
                </div>
            @endif

            <div class="prose max-w-none text-lg text-gray-700 leading-relaxed">
                {{-- Konten berita dalam format HTML --}}
                {!! $article->content !!}
            </div>

            <div class="mt-10 pt-6 border-t">
                {{-- PERBAIKAN: Menggunakan route news.index sesuai web.php --}}
                <a href="{{ route('news.index') }}" class="text-primary hover:text-secondary font-medium transition duration-150">&larr; Kembali ke Daftar Berita</a>
            </div>

        </div>
    </section>
@endsection
