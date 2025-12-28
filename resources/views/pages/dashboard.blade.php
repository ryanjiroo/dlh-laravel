@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Berita</h2>
        <button onclick="openModal()" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-opacity-90">Tambah Berita</button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <th class="p-3 border-b">Gambar</th>
                    <th class="p-3 border-b">Judul</th>
                    <th class="p-3 border-b">Status</th>
                    <th class="p-3 border-b">Tanggal</th>
                    <th class="p-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-3 border-b">
                        @if ($item->image)
                            {{-- PERBAIKAN: Thumbnail dari S3 --}}
                            <img src="{{ Storage::disk('s3')->url($item->image) }}" class="w-16 h-12 object-cover rounded shadow-sm">
                        @else
                            <div class="w-16 h-12 bg-gray-200 flex items-center justify-center rounded text-[10px] text-gray-400">No Image</div>
                        @endif
                    </td>
                    <td class="p-3 border-b font-medium text-gray-800">{{ Str::limit($item->title, 50) }}</td>
                    <td class="p-3 border-b text-sm">
                        <span class="px-2 py-1 rounded-full {{ $item->status == 'Published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="p-3 border-b text-sm text-gray-500">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="p-3 border-b">
                        {{-- Aksi Edit dan Hapus --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
