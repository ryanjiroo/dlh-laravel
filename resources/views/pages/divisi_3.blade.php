@extends('layouts.app')

@section('title', 'Pengendalian Pencemaran - DLH')

@section('content')
    <section class="py-16 px-4 md:px-12 lg:px-20 min-h-screen"> 
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-extrabold text-accent font-montserrat mb-3">Bidang Pengendalian Pencemaran dan Kerusakan Lingkungan</h1>
            <p class="text-lg text-dlh-dark mb-10">
                Bidang ini berfokus pada pemantauan dan pengendalian kualitas lingkungan. Tugasnya mencakup pengukuran tingkat polusi air dan udara, serta pencegahan meluasnya kerusakan ekosistem akibat aktivitas industri atau non-industri. Program ini sangat vital untuk menjaga kesehatan masyarakat dan integritas alam.
            </p>

            <h2 class="text-2xl font-bold text-dlh-dark font-montserrat mb-6 mt-12">Program Utama</h2>
            <ul class="list-disc list-inside space-y-2 text-lg text-gray-700 ml-5">
                <li>Pemantauan Kualitas Air Sungai, Danau, dan Sumur Pantau secara berkala.</li>
                <li>Pengujian dan Pengawasan Emisi Sumber Tidak Bergerak (Industri).</li>
                <li>Program Langit Biru untuk peningkatan kualitas udara perkotaan.</li>
                <li>Rehabilitasi dan Pemulihan Lokasi yang Mengalami Kerusakan Lingkungan.</li>
            </ul>

            <p class="text-center mt-12">
                <a href="{{ route('divisi.index') }}" class="text-primary hover:text-opacity-80 font-medium">&larr; Kembali ke Daftar Divisi</a>
            </p>

        </div>
    </section>
@endsection