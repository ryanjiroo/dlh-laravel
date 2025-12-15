@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    {{-- Dashboard Admin: Pastikan layout utama tidak menambahkan padding top berlebihan --}}
    <section class="py-10 px-4 md:px-12 lg:px-20 min-h-screen bg-gray-100"> 
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-extrabold text-secondary font-montserrat mb-6">Dashboard Admin</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                {{-- Card 1: Total Berita --}}
                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-indigo-500">
                    <p class="text-sm font-medium text-gray-500">Total Berita</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">125</p>
                </div>
                {{-- Card 2: Feedback Belum Terbaca --}}
                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-red-500">
                    <p class="text-sm font-medium text-gray-500">Feedback Baru</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">5</p>
                </div>
                {{-- Card 3: Logout --}}
                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-gray-500 flex items-center justify-between">
                    <p class="text-xl font-bold text-gray-900">Keluar</p>
                    {{-- Fix Logout: Menggunakan action URL langsung jika route('logout') tidak ada --}}
                    <form method="POST" action="{{ url('/logout') }}"> 
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            {{-- Tabel Pengelolaan Berita (Dibutuhkan Modals yang Hilang di Log Error) --}}
            <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Manajemen Berita</h3>
                    <button data-modal-target="add-news-modal" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                        + Tambah Berita
                    </button>
                </div>
                <p class="text-gray-500 p-4 border border-dashed rounded">Tabel data berita akan dimuat di sini.</p>
            </div>

            {{-- Tabel Feedback/Pesan Masuk --}}
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Pesan Masuk (Feedback)</h3>
                 <p class="text-gray-500 p-4 border border-dashed rounded">Tabel data feedback akan dimuat di sini.</p>
            </div>
        </div>
    </section>
@endsection
