@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <section class="mt-20 pb-16 px-4 md:px-12 lg:px-20 min-h-screen max-w-4xl mx-auto"> 
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-primary font-montserrat mb-3">{{ $article->title }}</h1>
            <p class="text-sm text-gray-500">
                Oleh: {{ $article->author }} | Tanggal: {{ $article->created_at->translatedFormat('d F Y') }}
            </p>
        </div>

        <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
            {{-- Pemanggilan Gambar Berita --}}
            <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('default_news.jpg') }}" 
                 alt="{{ $article->title }}" 
                 class="w-full h-96 object-cover">
        </div>

        <div class="prose max-w-none text-dlh-dark leading-relaxed">
            {!! nl2br(e($article->content)) !!} 
        </div>

        <div class="mt-12 pt-6 border-t border-gray-200">
            <a href="{{ route('news.index') }}" class="text-primary font-medium hover:text-opacity-80">&larr; Kembali ke Daftar Berita</a>
        </div>
    </section>
@endsection