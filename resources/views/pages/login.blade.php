@extends('layouts.app')

@section('title', 'Log In - Dinas Lingkungan Hidup')

@section('content')
<section class="flex justify-center items-start min-h-[calc(100vh-200px)] py-16">
    <div class="w-full max-w-sm bg-white p-8 rounded-xl shadow-lg border border-gray-100 text-center">
        
        {{-- Logo dan Tagline --}}
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('dlhLogo.png') }}" alt="DLH Logo" class="h-12 mb-1">
            <p class="text-sm font-semibold text-primary font-montserrat leading-none">Beyond Clean & Green</p>
        </div>

        <h1 class="text-2xl font-bold text-primary mb-1 font-montserrat">Selamat Datang</h1>
        <p class="text-gray-500 text-sm mb-8">Masuk ke akun Departemen Lingkungan Anda.</p>

        {{-- Form diarahkan ke route login.post yang diproses oleh LoginController --}}
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- Email atau Username --}}
            <div class="mb-5 text-left">
                <label for="email" class="block text-sm font-medium text-dlh-dark mb-1">Email atau Username</label>
                <div class="relative">
                    <input id="email" 
                           type="text" 
                           name="email" 
                           required 
                           autofocus 
                           placeholder="alamatemail@gmail.com"
                           value="{{ old('email') }}"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-dlh-dark focus:border-primary focus:ring-primary focus:outline-none @error('email') border-red-500 @enderror">
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-6 text-left">
                <label for="password" class="block text-sm font-medium text-dlh-dark mb-1">Password</label>
                <div class="relative">
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-dlh-dark focus:border-primary focus:ring-primary focus:outline-none @error('password') border-red-500 @enderror">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                
                <div class="text-right mt-1">
                    <a href="#" class="text-xs text-primary font-medium hover:text-opacity-80">Lupa password?</a>
                </div>
            </div>

            {{-- Tombol Login --}}
            <button type="submit" class="w-full bg-[#70AD2B] text-white py-3 rounded-lg font-bold text-lg hover:bg-opacity-90 transition-colors">
                Log In
            </button>
        </form>
    </div>
</section>
@endsection