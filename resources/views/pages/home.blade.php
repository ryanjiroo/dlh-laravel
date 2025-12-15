@extends('layouts.app')

@section('title', 'Dinas Lingkungan Hidup - Beyond Clean & Green')

@section('content')
    {{-- Hero Section --}}
    <section class="relative h-[70vh] flex flex-col justify-center items-center text-center text-white">
        <div class="absolute inset-0 bg-cover bg-center brightness-50 z-10" 
            style="background-image: url('{{ asset('background.png') }}');">
        </div>
        <div class="relative z-20">
            <h1 class="text-4xl sm:text-5xl font-extrabold mb-2 font-montserrat tracking-tight">Dinas Lingkungan Hidup</h1>
            <p class="text-lg sm:text-xl font-normal mb-8">Beyond Clean & Green</p>
            <a href="#berita-section" class="bg-accent text-dlh-dark px-10 py-3 rounded-xl text-lg font-semibold hover:bg-opacity-80 transition-colors">Explore</a>
        </div>
    </section>

    {{-- Berita Terkini Section --}}
    <section id="berita-section" class="py-16 px-4 md:px-12 lg:px-20 text-center bg-background">
        <h2 class="text-3xl font-normal mb-12 text-dlh-dark font-montserrat">Berita Terkini</h2>
        <div class="flex flex-wrap justify-center gap-5 mb-12">
            
            @forelse ($latestNews as $article)
            {{-- Card Berita dari Database --}}
            <div class="w-72 rounded-xl overflow-hidden text-left shadow-lg flex flex-col justify-between bg-white">
                {{-- Pemanggilan Gambar Berita --}}
                <div class="h-44 bg-cover bg-center flex-shrink-0"
                     style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : asset('berita1.jpg') }}');">
                </div>
                <div class="bg-secondary/90 p-4 flex-grow flex flex-col justify-center">
                    <h3 class="text-lg font-semibold mb-1 text-primary leading-snug font-montserrat">{{ $article->title }}</h3>
                    <p class="text-sm text-[#555] leading-snug">{{ $article->excerpt }}</p>
                    <a href="{{ route('news.show', $article->slug) }}" class="text-sm font-semibold text-primary hover:text-opacity-80 transition-colors mt-2">Baca selengkapnya</a>
                </div>
            </div>
            @empty
                <p>Belum ada berita yang diterbitkan saat ini.</p>
            @endforelse

            {{-- Placeholder cards (Dipotong agar data dinamis tampil) --}}
            @if ($latestNews->count() < 4)
                @for ($i = 0; $i < (4 - $latestNews->count()); $i++)
                    <div class="w-72 h-96 rounded-xl overflow-hidden text-left shadow-lg flex items-center justify-center bg-secondary">
                        <img src="{{ asset('images/berita2.jpg') }}" alt="placeholder" class="w-36 h-36 object-cover">
                    </div>
                @endfor
            @endif
            
        </div>
        <a href="{{ route('news.index') }}" class="bg-accent text-dlh-dark px-8 py-3 rounded-xl font-semibold hover:bg-opacity-80 transition-colors">Baca Selengkapnya</a>
    </section>

    {{-- Saran/Feedback Section (Tidak Berubah) --}}
    <section class="flex flex-col lg:flex-row bg-secondary py-16 px-8 md:px-12 lg:px-20 gap-10">
        <div class="lg:w-1/2">
            @if (session('success'))
                <div class="bg-primary/20 text-primary p-3 rounded-xl mb-4 text-center font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('feedback.submit') }}" class="feedback-form">
                @csrf
                <textarea name="message" class="w-full min-h-[200px] p-4 border-2 border-gray-300 rounded-xl resize-none text-base mb-4 bg-white text-dlh-dark placeholder-gray-500 focus:outline-none focus:border-primary @error('message') border-red-500 @enderror" placeholder="Tulis saranmu disini" required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror
                
                <input type="text" name="sender_name" placeholder="Nama Anda (Opsional)" class="w-full p-3 border-2 border-gray-300 rounded-xl mb-4 bg-white text-dlh-dark placeholder-gray-500 focus:outline-none focus:border-primary">
                <input type="email" name="sender_email" placeholder="Email Anda (Opsional)" class="w-full p-3 border-2 border-gray-300 rounded-xl mb-4 bg-white text-dlh-dark placeholder-gray-500 focus:outline-none focus:border-primary">

                <button type="submit" class="bg-accent text-dlh-dark py-3 rounded-xl font-semibold cursor-pointer w-full hover:bg-opacity-80 transition-colors border-none">Kirim saran</button>
            </form>
        </div>
        <div class="lg:w-1/2 text-dlh-dark lg:pl-10">
            <h2 class="text-4xl sm:text-5xl font-extrabold text-dlh-dark mb-5 leading-tight tracking-tight font-montserrat">Bantu Kami Menjadi Lebih Baik</h2>
            <p class="text-lg leading-relaxed">Kami sangat menghargai masukan Anda. Berikan saran untuk membantu kami meningkatkan layanan.</p>
        </div>
    </section>
@endsection
