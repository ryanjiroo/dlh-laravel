@extends('layouts.app')

@section('title', 'Divisi - Dinas Lingkungan Hidup')

@section('content')
    <section class="py-16 px-4 md:px-12 lg:px-20 min-h-screen"> 
        <h1 class="text-4xl font-extrabold text-primary font-montserrat mb-10 text-center">Divisi & Bidang Kerja</h1>
        <p class="text-center text-lg text-dlh-dark mb-16 max-w-3xl mx-auto">
            Dinas Lingkungan Hidup Kapuas dibagi menjadi beberapa bidang kerja utama yang fokus pada pelestarian, pengendalian, dan pengelolaan lingkungan secara berkelanjutan.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
            
            {{-- Card 1: Tata Lingkungan dan Kehutanan --}}
            <a href="{{ route('divisi.show_tata_lingkungan') }}" class="group bg-white p-6 rounded-xl shadow-soft hover:shadow-xl transition-shadow duration-300 transform hover:scale-[1.02] border-t-4 border-primary">
                <div class="flex flex-col items-center text-center">
                    {{-- Icon Pohon/Lingkungan --}}
                    <svg class="w-12 h-12 text-primary mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-dlh-dark group-hover:text-primary transition-colors font-montserrat">
                        Tata Lingkungan dan Kehutanan
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">Perencanaan, inventarisasi, dan pelestarian sumber daya alam.</p>
                </div>
            </a>

            {{-- Card 2: Pengelolaan Sampah Limbah B3 --}}
            <a href="{{ route('divisi.show_sampah') }}" class="group bg-white p-6 rounded-xl shadow-soft hover:shadow-xl transition-shadow duration-300 transform hover:scale-[1.02] border-t-4 border-secondary">
                <div class="flex flex-col items-center text-center">
                    {{-- Icon Sampah/Limbah --}}
                    <svg class="w-12 h-12 text-secondary mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.86 12.04a2 2 0 01-2 1.96H7.86a2 2 0 01-2-1.96L5 7m5-3V3a1 1 0 011-1h2a1 1 0 011 1v1m4 0h-3.414M9 5h6"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-dlh-dark group-hover:text-secondary transition-colors font-montserrat">
                        Pengelolaan Sampah, Limbah B3
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">Fokus pada daur ulang, pembuangan aman, dan penanganan B3.</p>
                </div>
            </a>
            
            {{-- Card 3: Pengendalian Pencemaran dan Kerusakan Lingkungan --}}
            <a href="{{ route('divisi.show_pengendalian') }}" class="group bg-white p-6 rounded-xl shadow-soft hover:shadow-xl transition-shadow duration-300 transform hover:scale-[1.02] border-t-4 border-accent">
                <div class="flex flex-col items-center text-center">
                    {{-- Icon Kualitas Udara/Air --}}
                    <svg class="w-12 h-12 text-accent mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4m-4 4h7m9-10v8a2 2 0 01-2 2h-2M11 13h10a2 2 0 002-2V9a2 2 0 00-2-2H11"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-dlh-dark group-hover:text-accent transition-colors font-montserrat">
                        Pengendalian Pencemaran dan Kerusakan Lingkungan
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">Pemantauan kualitas air, udara, dan pencegahan kerusakan.</p>
                </div>
            </a>
            
            {{-- Card 4: Penataan dan Peningkatan Kapasitas Lingkungan Hidup --}}
            <a href="{{ route('divisi.show_kapasitas') }}" class="group bg-white p-6 rounded-xl shadow-soft hover:shadow-xl transition-shadow duration-300 transform hover:scale-[1.02] border-t-4 border-dlh-dark">
                <div class="flex flex-col items-center text-center">
                    {{-- Icon Kapasitas/Edukasi --}}
                    <svg class="w-12 h-12 text-dlh-dark mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.5l4 4-4 4"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17h10"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10.5V17"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-dlh-dark group-hover:text-dlh-dark transition-colors font-montserrat">
                        Penataan dan Peningkatan Kapasitas Lingkungan Hidup
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">Edukasi publik, pelatihan, dan penataan kelembagaan.</p>
                </div>
            </a>

        </div>
    </section>
@endsection