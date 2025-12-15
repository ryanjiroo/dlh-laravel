@extends('layouts.app')

@section('title', 'Tata Lingkungan dan Kehutanan - DLH')

@section('content')
    <section class="py-16 px-4 md:px-12 lg:px-20 min-h-screen"> 
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-extrabold text-primary font-montserrat mb-3">Bidang Tata Lingkungan dan Kehutanan</h1>
            <p class="text-lg text-dlh-dark mb-10">
                Bidang ini merupakan garda terdepan dalam perencanaan tata ruang lingkungan yang berkelanjutan. Fokus utamanya adalah pada inventarisasi, pemanfaatan, dan konservasi sumber daya alam, termasuk pengelolaan areal hutan dan lahan kritis. Bidang ini juga memastikan setiap pembangunan memenuhi standar AMDAL (Analisis Mengenai Dampak Lingkungan).
            </p>

            <h2 class="text-2xl font-bold text-dlh-dark font-montserrat mb-6 mt-12">Program Utama</h2>
            <ul class="list-disc list-inside space-y-2 text-lg text-gray-700 ml-5">
                <li>Penyusunan dan Evaluasi Dokumen Lingkungan Hidup (AMDAL, UKL/UPL).</li>
                <li>Inventarisasi Potensi Sumber Daya Alam dan Energi Terbarukan.</li>
                <li>Pengawasan dan Rehabilitasi Lahan Kritis dan Area Konservasi.</li>
                <li>Penegakan Hukum terkait perizinan lingkungan.</li>
            </ul>

            <p class="text-center mt-12">
                <a href="{{ route('divisi.index') }}" class="text-primary hover:text-opacity-80 font-medium">&larr; Kembali ke Daftar Divisi</a>
            </p>

        </div>
    </section>
@endsection