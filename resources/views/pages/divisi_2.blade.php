@extends('layouts.app')

@section('title', 'Pengelolaan Sampah - Dinas Lingkungan Hidup')

@section('content')
    <section class="py-16 px-4 md:px-12 lg:px-20 min-h-screen">
        <div class="max-w-6xl mx-auto">

            <h1 class="text-4xl font-extrabold text-secondary font-montserrat mb-3">
                Bidang Pengelolaan Sampah, Limbah B3
            </h1>

            <p class="text-lg text-dlh-dark mb-10">
                Bidang ini bertanggung jawab penuh atas perencanaan, pelaksanaan, dan pengawasan kegiatan yang berkaitan
                dengan pengelolaan sampah perkotaan, limbah non-B3, serta penanganan limbah Bahan Berbahaya dan Beracun (B3)
                di wilayah Kapuas.
            </p>

            <h2 class="text-3xl font-bold text-primary font-montserrat mb-10 mt-12">
                Visualisasi Data Sampah 2025
            </h2>

            {{-- BAR CHART --}}
            <div class="bg-white p-8 rounded-2xl shadow-md mb-10 border">
                <h3 class="text-xl font-semibold mb-2">
                    Estimasi Timbulan Sampah per Kecamatan
                </h3>
                <p class="text-sm text-gray-600 mb-6">
                    Estimasi total timbulan sampah (ton/tahun) berdasarkan data historis dan pertumbuhan penduduk.
                </p>

                <div id="chart_timbulan" class="w-full h-[520px]"></div>
            </div>

            {{-- DONUT CHART --}}
            <div class="bg-white p-8 rounded-2xl shadow-md mb-10 border">
                <h3 class="text-xl font-semibold mb-2">
                    Distribusi Timbangan Sampah Fasilitas
                </h3>
                <p class="text-sm text-gray-600 mb-6">
                    Persentase kontribusi fasilitas pengelolaan sampah Semester 1 Tahun 2025.
                </p>

                <div class="flex flex-col items-center gap-6">
                    <div id="chart_timbangan" class="w-[360px] h-[360px]"></div>

                    {{-- LEGEND MANUAL --}}
                    <div class="flex gap-6 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-blue-600"></span>
                            <span>TPA</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-green-500"></span>
                            <span>Bank Sampah</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-yellow-500"></span>
                            <span>TPS3R</span>
                        </div>
                    </div>
                </div>
            </div>


            <p class="text-center mt-12">
                <a href="{{ route('divisi.index') }}" class="text-primary font-medium hover:underline">
                    &larr; Kembali ke Daftar Divisi
                </a>
            </p>

        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vega@5"></script>
    <script src="https://cdn.jsdelivr.net/npm/vega-lite@5"></script>
    <script src="https://cdn.jsdelivr.net/npm/vega-embed@6"></script>

    <script>
        window.onload = function () {

            /* =======================
               BAR CHART – TIMBULAN
            ======================= */
            const timbulanSpec = {
                $schema: "https://vega.github.io/schema/vega-lite/v5.json",
                width: "container",
                height: 420,

                data: {
                    values: [
                        { kecamatan: "Selat", nilai: 13368125 },
                        { kecamatan: "Bataguh", nilai: 8152275 },
                        { kecamatan: "Kapuas Timur", nilai: 5819925 },
                        { kecamatan: "Kapuas Kuala", nilai: 4144575 },
                        { kecamatan: "Tamban Catur", nilai: 3140825 },
                        { kecamatan: "Kapuas Murung", nilai: 2855175 },
                        { kecamatan: "Kapuas Barat", nilai: 2503250 },
                        { kecamatan: "Dadahup", nilai: 2341400 },
                        { kecamatan: "Mantangai", nilai: 2095300 },
                        { kecamatan: "Kapuas Tengah", nilai: 1827400 },
                        { kecamatan: "Kapuas Hilir", nilai: 1782200 },
                        { kecamatan: "Basarang", nilai: 1740900 },
                        { kecamatan: "Mandau Talawang", nilai: 1718000 },
                        { kecamatan: "Timapah", nilai: 1600725 },
                        { kecamatan: "Paser Kuala", nilai: 1566100 },
                        { kecamatan: "Pulau Petak", nilai: 1475725 },
                        { kecamatan: "Jelapat", nilai: 1400000 }
                    ]
                },

                mark: {
                    type: "bar",
                    cornerRadiusTopLeft: 6,
                    cornerRadiusTopRight: 6
                },

                encoding: {
                    x: {
                        field: "kecamatan",
                        type: "nominal",
                        sort: "-y",
                        axis: {
                            title: "Kecamatan",
                            labelAngle: -40,
                            labelPadding: 8
                        }
                    },
                    y: {
                        field: "nilai",
                        type: "quantitative",
                        title: "Timbulan Sampah (Ton / Tahun)",
                        axis: {
                            grid: true,
                            format: "~s"
                        }
                    },
                    color: {
                        value: "#2563eb"
                    },
                    tooltip: [
                        { field: "kecamatan", type: "nominal", title: "Kecamatan" },
                        { field: "nilai", type: "quantitative", format: ",.0f", title: "Ton/Tahun" }
                    ]
                },

                config: {
                    axis: {
                        labelFontSize: 12,
                        titleFontSize: 13
                    }
                }
            };

            vegaEmbed("#chart_timbulan", timbulanSpec, { actions: false });


            /* =======================
               DONUT CHART – TIMBANGAN
            ======================= */
            const timbanganSpec = {
                $schema: "https://vega.github.io/schema/vega-lite/v5.json",

                width: 360,
                height: 360,

                data: {
                    values: [
                        { fasilitas: "TPA", nilai: 12000 },
                        { fasilitas: "Bank Sampah", nilai: 523.09 },
                        { fasilitas: "TPS3R", nilai: 1500 }
                    ]
                },

                transform: [
                    {
                        joinaggregate: [
                            { op: "sum", field: "nilai", as: "total" }
                        ]
                    },
                    {
                        calculate: "datum.nilai / datum.total * 100",
                        as: "persen"
                    }
                ],

                mark: {
                    type: "arc",
                    innerRadius: 90,
                    outerRadius: 150,
                    stroke: "#ffffff",
                    strokeWidth: 2
                },

                encoding: {
                    theta: {
                        field: "nilai",
                        type: "quantitative",
                        stack: true
                    },
                    color: {
                        field: "fasilitas",
                        type: "nominal",
                        legend: null,
                        scale: {
                            domain: ["TPA", "Bank Sampah", "TPS3R"],
                            range: ["#2563eb", "#22c55e", "#f59e0b"]
                        }
                    },
                    tooltip: [
                        { field: "fasilitas", type: "nominal", title: "Fasilitas" },
                        { field: "nilai", type: "quantitative", format: ",.1f", title: "Ton" },
                        { field: "persen", type: "quantitative", format: ".1f", title: "Persentase (%)" }
                    ]
                },

                config: {
                    view: { stroke: null }
                }
            };
            vegaEmbed('#chart_timbangan', timbanganSpec, { actions: false });
        };
    </script>
@endpush