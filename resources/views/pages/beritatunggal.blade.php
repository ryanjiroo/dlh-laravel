@extends('layouts.app')

@section('title', $berita->title)

@section('content')
    <section class="py-16 px-4 md:px-12 lg:px-20 min-h-screen bg-gray-50"> 
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            
            <h1 class="text-4xl font-extrabold text-gray-900 font-montserrat mb-4">{{ $berita->title }}</h1>
            <div class="text-sm text-gray-500 mb-6 border-b pb-4">
                Dipublikasikan oleh <strong>{{ $berita->author }}</strong> pada {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}
            </div>

            {{-- KRUSIAL: Menggunakan asset() untuk path gambar database --}}
            @if ($berita->image)
                <div class="mb-8 overflow-hidden rounded-lg shadow-md">
                    <img 
                        src="{{ asset($berita->image) }}" 
                        alt="{{ $berita->title }}" 
                        class="w-full h-auto object-cover" 
                        style="max-height: 400px;"
                    >
                </div>
            @endif

            <div class="prose max-w-none text-lg text-gray-700">
                {{-- Asumsi konten berita tersimpan sebagai HTML --}}
                {!! $berita->content !!}
            </div>

            <div class="mt-10 pt-6 border-t">
                <a href="{{ route('berita') }}" class="text-primary hover:text-secondary font-medium transition duration-150">&larr; Kembali ke Daftar Berita</a>
            </div>

        </div>
    </section>
@endsection
