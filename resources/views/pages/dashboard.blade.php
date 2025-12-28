@extends('layouts.app')

@section('title', 'Admin Dashboard - Dinas Lingkungan Hidup')

@section('content')
<section class="mt-20 pb-16 px-4 md:px-12 lg:px-20 min-h-screen bg-gray-50">
    <div class="flex flex-col gap-8">
        
        {{-- Bagian Manajemen Berita --}}
        <div class="p-6 bg-white rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 font-montserrat">Manajemen Berita</h2>
                <a href="{{ route('news.create') }}" class="bg-primary text-white px-5 py-2 rounded-lg hover:bg-opacity-90 transition shadow-sm">
                    + Tambah Berita
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <th class="p-3 border-b">Gambar</th>
                            <th class="p-3 border-b">Judul</th>
                            <th class="p-3 border-b">Status</th>
                            <th class="p-3 border-b">Tanggal</th>
                            <th class="p-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-3 border-b">
                                @if ($item->image)
                                    {{-- Mengambil URL dari Supabase S3 --}}
                                    <img src="{{ Storage::disk('s3')->url($item->image) }}" class="w-16 h-12 object-cover rounded shadow-sm">
                                @else
                                    <div class="w-16 h-12 bg-gray-200 flex items-center justify-center rounded text-[10px] text-gray-400">No Image</div>
                                @endif
                            </td>
                            <td class="p-3 border-b font-medium text-gray-800">
                                {{ Str::limit($item->title, 60) }}
                            </td>
                            <td class="p-3 border-b text-sm">
                                <span class="px-2 py-1 rounded-full {{ $item->status == 'Published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-3 border-b text-sm text-gray-500">
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </td>
                            <td class="p-3 border-b">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('news.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-500 italic">Belum ada berita yang dibuat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bagian Manajemen Feedback --}}
        <div class="p-6 bg-white rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 font-montserrat">Saran & Masukan</h2>
                @if($unreadFeedbackCount > 0)
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadFeedbackCount }} Baru</span>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <th class="p-3 border-b">Pengirim</th>
                            <th class="p-3 border-b">Pesan</th>
                            <th class="p-3 border-b">Tanggal</th>
                            <th class="p-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $fb)
                        <tr class="{{ !$fb->is_read ? 'bg-blue-50' : '' }} hover:bg-gray-50 transition-colors">
                            <td class="p-3 border-b">
                                <div class="font-medium text-gray-800">{{ $fb->sender_name ?? 'Anonim' }}</div>
                                <div class="text-xs text-gray-500">{{ $fb->sender_email ?? '-' }}</div>
                            </td>
                            <td class="p-3 border-b text-sm text-gray-600">
                                {{ Str::limit($fb->message, 100) }}
                            </td>
                            <td class="p-3 border-b text-sm text-gray-500">
                                {{ $fb->created_at->diffForHumans() }}
                            </td>
                            <td class="p-3 border-b text-center">
                                <a href="{{ route('feedback.show', $fb->id) }}" class="text-primary hover:underline font-medium">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-500 italic">Belum ada saran yang masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection
