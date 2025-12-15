@extends('layouts.app')

@section('title', 'Penataan dan Peningkatan Kapasitas - DLH')

@section('content')
    <section class="py-16 px-4 md:px-12 lg:px-20 min-h-screen"> 
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-extrabold text-dlh-dark font-montserrat mb-3">Bidang Penataan dan Peningkatan Kapasitas Lingkungan Hidup</h1>
            <p class="text-lg text-dlh-dark mb-10">
                Bidang ini berfungsi sebagai pusat informasi, edukasi, dan pengembangan sumber daya manusia dalam lingkup Dinas Lingkungan Hidup dan masyarakat umum. Tujuannya adalah membangun kesadaran kolektif dan kapasitas teknis untuk partisipasi aktif dalam pelestarian lingkungan.
            </p>

            <h2 class="text-2xl font-bold text-dlh-dark font-montserrat mb-6 mt-12">Program Utama</h2>
            <ul class="list-disc list-inside space-y-2 text-lg text-gray-700 ml-5">
                <li>Penyelenggaraan Program Sekolah Adiwiyata dan Gerakan Peduli Lingkungan.</li>
                <li>Pelatihan dan Sertifikasi Pengelola Lingkungan Hidup.</li>
                <li>Pengembangan Sistem Informasi Lingkungan (SILH) yang terintegrasi.</li>
                <li>Fasilitasi Kelompok Masyarakat Peduli Lingkungan (KMPL).</li>
            </ul>

            <p class="text-center mt-12">
                <a href="{{ route('divisi.index') }}" class="text-primary hover:text-opacity-80 font-medium">&larr; Kembali ke Daftar Divisi</a>
            </p>

        </div>
    </section>
@endsection